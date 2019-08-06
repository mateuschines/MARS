<?php

if (isset ( $_GET["id"])) {
    $id = trim ($_GET["id"]);
}

if (empty ( $id )) {
    echo "<script>alert('Id não é valido.');history.back();</script>";
    exit;
}

$json_file = file_get_contents("https://mateuschineis.tk/salvar/../json/comprasRealizadasProdutos.php?id=$id");

$json_str = json_decode($json_file, true);

include "../assets/FPDF/fpdf.php";

class myPDF extends FPDF{
    function header(){
        $date = date('d-m-Y H:i');				
        $this->Image('../images/imagens/Drrnovo.png',10,3);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,05,'RELATORIO ',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',12);
        $this->Cell(276,10,'Produtos Comprados',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',12);
        //$this->Cell(276,10,"Data e Hora: ". $date,0,0,'C');
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Arial','B',12);
        //$this->Cell(20,5,'ID',1,0,'C');
        $this->Cell(145,5,'NOME DO PRODUTO',1,0,'C');
        $this->Cell(40,5,'QUANTIDADE',1,0,'C');
        $this->Cell(40,5,'VALOR R$',1,0,'C');
        $this->Ln();
    } function viewTable($json_str){
        $this->SetFont('Arial','',12);
        //$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
        $somatotal = 0.00;
        foreach ( $json_str as $p ){
            if ( isset ( $p["nome"] ) ) $this->Cell(145,7,utf8_decode($p["nome"]),1,0,"C");
            if ( isset ( $p["quantidade"] ) ) $this->Cell(40,7,$p["quantidade"],1,0,"C");
            if ( isset ( $p["preco"] ) ) $this->Cell(40,7,$p["preco"],1,0,"C").$this->Ln();

            if ( isset ( $p["somaProduto"] ) ) $somatotal += $p["somaProduto"];
             
        }

        $total = number_format($somatotal,2,",",".");
        $this->SetFont('Arial','B',12);
        $this->Ln();
        if ( isset ( $p["nomeCliente"] ) ) $this->Cell(145,7,"Cliente: ".$p["nomeCliente"],1,0,"L");
        if ( isset ( $p["nomeCliente"] ) ) $this->Cell(40,7,"Data: ".$p["data"],1,0,"C");
        $this->Cell(40,7,"TOTAL: ".$total,1,0,"R");
    }
}

$pdf = new myPDF();
$pdf->SetTitle('Relatorio de Cliente');
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($json_str);
$pdf->Output();

