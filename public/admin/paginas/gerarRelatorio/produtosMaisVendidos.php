<?php

require '../../../../autoload.php';

$mercado = $dataInicial = $dataFinal = "";
session_cache_expire(5);
    session_start();
    
if (isset ( $_SESSION["sistema"]["mercado"])) {
    $mercado = $_SESSION["sistema"]["mercado"];
    
}
if (isset ( $_POST["dataInicial"])) {
    $dataInicial = trim ($_POST["dataInicial"]);
    $dataInicial = explode("/",$dataInicial);
    $dataInicial = $dataInicial[2]."-".$dataInicial[1]."-".$dataInicial[0];

}
if (isset ( $_POST["dataFinal"])) {
    $dataFinal = trim ($_POST["dataFinal"]);
    $dataFinal = explode("/",$dataFinal);
	$dataFinal = $dataFinal[2]."-".$dataFinal[1]."-".$dataFinal[0];
}

if (empty ( $dataInicial ) || empty ( $dataFinal ) ) {
    echo "<script>alert('Datas não sao validas.');history.back();</script>";
    exit;
}

if ($dataInicial > $dataFinal) {
    echo "<script>alert('Data invalida');history.back();</script>";
	exit;
}

use Carrinho\Carrinho;

$carrinhoP = new Carrinho();

$result = $carrinhoP->gerarRelatorioProdutoMaisVendidoPorData($mercado, $dataInicial, $dataFinal);

include "../../../assets/FPDF/fpdf.php";

class myPDF extends FPDF{
    function header(){
        $date = date('d-m-Y H:i');				
        $this->Image('Drrnovo.png',10,3);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,05,'RELATORIO ',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Produtos Mais Vendidos',0,0,'C');
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
        $this->Cell(70,5,'NOME DO PRODUTO',1,0,'C');
        $this->Cell(60,5,'CATEGORIA',1,0,'C');
        $this->Cell(60,5,'VALOR R$',1,0,'C');
        $this->Cell(60,5,'QUANTIDADE',1,0,'C');
        $this->Ln();
    } function viewTable($result){
        $this->SetFont('Arial','',12);
        //$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
        $somatotal = 0.00;
        foreach ( $result as $p ){
            if ( isset ( $p->preco ) ) $valorF = number_format($p->preco,2,",",".");
            

                if ( isset ( $p->nome ) ) $this->Cell(70,7,utf8_decode($p->nome),1,0,"C");
                if ( isset ( $p->nomeCategoria ) ) $this->Cell(60,7,utf8_decode($p->nomeCategoria),1,0,"C");
                if ( isset ( $valorF ) ) $this->Cell(60,7,$valorF,1,0,"C");
                if ( isset ( $p->quantos ) ) $this->Cell(60,7,$p->quantos,1,0,"C").$this->Ln();
           
             
        }

        // $total = number_format($somatotal,2,",",".");
        // $this->SetFont('Arial','B',12);
        // $this->Ln();
        // if ( isset ( $p["nomeCliente"] ) ) $this->Cell(145,7,"Cliente: ".$p["nomeCliente"],1,0,"L");
        // if ( isset ( $p["nomeCliente"] ) ) $this->Cell(40,7,"Data: ".$p["data"],1,0,"C");
        // $this->Cell(40,7,"TOTAL: ".$total,1,0,"R");
    }
}

$pdf = new myPDF();


$pdf->SetTitle('Relatorio de Produtos Mais Vendidos');

$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($result);
$pdf->Output();
