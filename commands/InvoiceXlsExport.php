<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/29/2018
 * Time: 6:38 PM
 */

namespace app\commands;


use app\models\Order;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

/**
 * @property Order $order
 * @property Spreadsheet $xls
 */
class InvoiceXlsExport
{
    public $order;
    public $xls;
    public $rowCount = 1;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->xls = new Spreadsheet();
    }

    public function export()
    {
        $this->xls->getProperties()->setTitle("Activities");
        $this->xls->setActiveSheetIndex(0);
        $this->setHeader();
        $this->setTable();

        return $this->xls;
    }

    public function setHeader()
    {
        $this->xls->getActiveSheet()->mergeCells('A3:H3');
        $this->xls->getActiveSheet()->setCellValue('A3', 'ПРЕДАВАТЕЛНО-ПРИЕМАТЕЛЕН ПРОТОКОЛ');
        $this->xls->getActiveSheet()->getStyle('A3:H3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->getStyle("A3:H3")->getFont()->setSize(16)->setBold(true);
        $this->xls->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

        $this->xls->getActiveSheet()->getRowDimension('4')->setRowHeight(10);

        $this->xls->getActiveSheet()->setCellValue('C5', '№');
        $this->xls->getActiveSheet()->getStyle("C5")->getFont()->setSize(16)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $this->xls->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
        $this->xls->getActiveSheet()->mergeCells('D5:E5');
        $this->xls->getActiveSheet()->mergeCells('F5:H5');
        $this->xls->getActiveSheet()->setCellValue('F5', date('d-m-Y') . 'г');
        $this->xls->getActiveSheet()->getStyle("F5:H5")->getFont()->setSize(16)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('F5:H5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $this->xls->getActiveSheet()->getRowDimension('6')->setRowHeight(10);

        $this->xls->getActiveSheet()->mergeCells('A7:C7');
        $this->xls->getActiveSheet()->setCellValue('A7', 'Подписаният:');
        $this->xls->getActiveSheet()->getStyle("A7")->getFont()->setBold(true);
        $this->xls->getActiveSheet()->getStyle('A7:C7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->getRowDimension('8')->setRowHeight(10);
        $this->xls->getActiveSheet()->mergeCells('D8:H8');
        $this->xls->getActiveSheet()->setCellValue('D8', '(име, фамилия, длъжност)');
        $this->xls->getActiveSheet()->getStyle("D8:H8")->getFont()->setSize(9)->setBold(true);

        $this->xls->getActiveSheet()->mergeCells('A9:C9');
        $this->xls->getActiveSheet()->setCellValue('A9', 'Предадох на:');
        $this->xls->getActiveSheet()->getStyle("A9")->getFont()->setBold(true);
        $this->xls->getActiveSheet()->getStyle('A9:C9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->getRowDimension('10')->setRowHeight(10);
        $this->xls->getActiveSheet()->mergeCells('D10:H10');
        $this->xls->getActiveSheet()->setCellValue('D10', '(име, фамилия, длъжност)');
        $this->xls->getActiveSheet()->getStyle("D10:H10")->getFont()->setSize(9)->setBold(true);

        $this->xls->getActiveSheet()->mergeCells('A11:B11');
        $this->xls->getActiveSheet()->setCellValue('A11', 'Следното:');
        $this->xls->getActiveSheet()->getStyle("A11")->getFont()->setBold(true);
    }

    public function setTable()
    {
        $this->setTableHeader();
        $this->setTableBody();
    }

    public function setTableHeader()
    {
        $this->xls->getActiveSheet()->setCellValue('A12', '№:');
        $this->xls->getActiveSheet()->mergeCells('B12:C12');
        $this->xls->getActiveSheet()->setCellValue('B12', 'Наименование');
        $this->xls->getActiveSheet()->mergeCells('D12:E12');
        $this->xls->getActiveSheet()->setCellValue('D12', 'Количество');
        $this->xls->getActiveSheet()->setCellValue('F12', 'Материал');
        $this->xls->getActiveSheet()->setCellValue('G12', 'Единична цена с материала');
        $this->xls->getActiveSheet()->setCellValue('H12', 'Общо цена');
    }

    public function setTableBody()
    {
        $products = $this->order->products;
        $displayCount = 1;
        $rowCount = 13;
        $totalPrice = 0;
        foreach ($products as $product)
        {
            $this->xls->getActiveSheet()->setCellValue('A' . $rowCount, $displayCount);
            $this->xls->getActiveSheet()->setCellValue('B' . $rowCount, $product->product_name);
            $this->xls->getActiveSheet()->setCellValue('D' . $rowCount, $product->quantity);
            $this->xls->getActiveSheet()->setCellValue('F' . $rowCount, $product->material->name);
            $this->xls->getActiveSheet()->setCellValue('G' . $rowCount, $product->single_price_with_material . 'лв');
            $this->xls->getActiveSheet()->setCellValue('H' . $rowCount, $product->price_with_dds . 'лв');

            $totalPrice += floatval($product->price_with_dds);
            $rowCount++;
            $displayCount++;
        }

        $this->xls->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(10);

        $this->xls->getActiveSheet()->mergeCells('A' . ($rowCount + 1) . ':C' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('A' . ($rowCount + 1), 'ПРЕДАЛ:');
        $this->xls->getActiveSheet()->getStyle('A' . ($rowCount + 1) . ':C' . ($rowCount + 1))->getFont()->setSize(16)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('A' . ($rowCount + 1) . ':C' . ($rowCount + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->mergeCells('G' . ($rowCount) . ':G' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('G' . $rowCount, 'Всичко:');
        $this->xls->getActiveSheet()->mergeCells('H' . ($rowCount) . ':H' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('H' . $rowCount, $totalPrice . 'лв');
    }

}