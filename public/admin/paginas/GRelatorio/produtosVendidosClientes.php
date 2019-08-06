<?php

$id = "";

if (isset ( $_GET["id"])) {
    $id = trim ($_GET["id"]);
}

if (empty ( $id )) {
    echo "<script>alert('Id não é valido.');history.back();</script>";
    exit;
}

require '../../../../autoload.php';


use Carrinho\Carrinho;

$carrinhoP = new Carrinho();

    $result = $carrinhoP->buscaCompraRealizadaComProdutos($id);




include "../../../assets/FPDF/fpdf.php";

class myPDF extends FPDF{
    function header(){
        $date = date('d-m-Y H:i');				
        $this->Image('Drrnovo.png',10,3);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,05,'RELATORIO ',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Produtos Comprados Pelo Cliente',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        //$this->Cell(276,10,"Data e Hora: ". $date,0,0,'C');
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times','B',12);
        //$this->Cell(20,5,'ID',1,0,'C');
        $this->Cell(145,5,'NOME DO PRODUTO',1,0,'C');
        $this->Cell(40,5,'QUANTIDADE',1,0,'C');
        $this->Cell(40,5,'VALOR R$',1,0,'C');
        $this->Ln();
    } function viewTable($json_str){
        $this->SetFont('Times','',12);
        //$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
        $somatotal = 0.00;
        foreach ( $json_str as $p ){
            $preco = number_format($p->valor,2,",",".");
            if ( isset ( $p->nome ) ) $this->Cell(145,7,$p->nome,1,0,"C");
            if ( isset ( $p->quantidade ) ) $this->Cell(40,7,$p->quantidade,1,0,"C");
            if ( isset ( $preco ) ) $this->Cell(40,7,$preco,1,0,"C").$this->Ln();

            if ( isset ( $p->valor ) ) $somatotal = ($somatotal + $p->valor) * $p->quantidade;
             
        }

        $total = number_format($somatotal,2,",",".");
        $this->SetFont('Arial','B',12);
        $this->Ln();
        if ( isset ( $p->nomeCliente ) ) $this->Cell(145,7,"Cliente: ".$p->nomeCliente,1,0,"L");
        if ( isset ( $p->nomeCliente ) ) $this->Cell(40,7,"Data: ".$p->dataCompra,1,0,"C");
        $this->Cell(40,7,"TOTAL: ".$total,1,0,"R");
    }
}

$pdf = new myPDF();
$pdf->SetTitle('Relatorio de Cliente');
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($result);
$pdf->Output();

