<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/29/2018
 * Time: 6:38 PM
 */

namespace app\commands;

use app\models\Order;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;

/**
 * @property Order $order
 * @property Spreadsheet $xls
 */
class TransmissionAndAcceptanceProtocolXlsExport implements ExcelExport
{
    public $order;
    public $xls;
    public $rowCount = 1;

    function loadData($order)
    {
        $this->order = $order;
        $this->xls = new Spreadsheet();
    }

    public function export()
    {
        $this->xls->getProperties()->setTitle("Activities");
        $this->xls->setActiveSheetIndex(0);
        $this->setStyleOptions();
        $this->setHeader();
        $this->setTable();

        return $this->xls;
    }

    public function setStyleOptions()
    {
        $this->xls->getActiveSheet()->setShowGridlines(false);
        $this->xls->getDefaultStyle()->getFont()->setName('Arial');
        $this->xls->getActiveSheet()->getColumnDimension('A')->setWidth(2.29);
        $this->xls->getActiveSheet()->getColumnDimension('B')->setWidth(11.57);
        $this->xls->getActiveSheet()->getColumnDimension('C')->setWidth(29);
        $this->xls->getActiveSheet()->getColumnDimension('D')->setWidth(4.29);
        $this->xls->getActiveSheet()->getColumnDimension('E')->setWidth(3.14);
        $this->xls->getActiveSheet()->getColumnDimension('F')->setWidth(20.57);
        $this->xls->getActiveSheet()->getColumnDimension('G')->setWidth(9.71);
        $this->xls->getActiveSheet()->getColumnDimension('H')->setWidth(12);
    }

    public function setHeader()
    {
        $this->xls->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $this->xls->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $drawing = new HeaderFooterDrawing();
        $drawing->setName('PhpSpreadsheet logo');
        $drawing->setCoordinates('A1');
        $drawing->setPath(\Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'metarempng.png');
        $drawing->setWorksheet($this->xls->getActiveSheet());

        $this->xls->getActiveSheet()->mergeCells('A3:H3');
        $this->xls->getActiveSheet()->setCellValue('A3', 'ПРЕДАВАТЕЛНО-ПРИЕМАТЕЛЕН ПРОТОКОЛ');
        $this->xls->getActiveSheet()->getStyle('A3:H3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->getStyle("A3:H3")->getFont()->setSize(14)->setBold(true);
        $this->xls->getActiveSheet()->getRowDimension('3')->setRowHeight(18);

        $this->xls->getActiveSheet()->getRowDimension('4')->setRowHeight(10);

        $this->xls->getActiveSheet()->setCellValue('C5', '№');
        $this->xls->getActiveSheet()->getStyle("C5")->getFont()->setSize(14)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $this->xls->getActiveSheet()->getRowDimension('5')->setRowHeight(18);
        $this->xls->getActiveSheet()->mergeCells('D5:E5');
        $this->xls->getActiveSheet()->setCellValue('D5', $this->order->id);
        $this->xls->getActiveSheet()->getStyle("D5:E5")->getFont()->setSize(14)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('D5:E5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $this->xls->getActiveSheet()->mergeCells('F5:H5');
        $this->xls->getActiveSheet()->setCellValue('F5', date('d-m-Y') . 'г');
        $this->xls->getActiveSheet()->getStyle("F5:H5")->getFont()->setSize(14)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('F5:H5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $this->xls->getActiveSheet()->getRowDimension('6')->setRowHeight(10);

        $this->xls->getActiveSheet()->getRowDimension('7')->setRowHeight(15.75);
        $this->xls->getActiveSheet()->mergeCells('A7:C7');
        $this->xls->getActiveSheet()->setCellValue('A7', 'Подписаният:');
        $this->xls->getActiveSheet()->getStyle("A7")->getFont()->setSize(12)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('A7:C7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->getRowDimension('8')->setRowHeight(10);
        $this->xls->getActiveSheet()->mergeCells('D8:H8');
        $this->xls->getActiveSheet()->setCellValue('D8', '(име, фамилия, длъжност)');
        $this->xls->getActiveSheet()->getStyle("D8:H8")->getFont()->setSize(8);

        $this->xls->getActiveSheet()->getRowDimension('9')->setRowHeight(15.75);
        $this->xls->getActiveSheet()->mergeCells('A9:C9');
        $this->xls->getActiveSheet()->setCellValue('A9', 'Предадох на:');
        $this->xls->getActiveSheet()->getStyle("A9")->getFont()->setSize(12)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('A9:C9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->getRowDimension('10')->setRowHeight(10);
        $this->xls->getActiveSheet()->mergeCells('D10:H10');
        $this->xls->getActiveSheet()->setCellValue('D10', '(име, фамилия, длъжност)');
        $this->xls->getActiveSheet()->getStyle("D10:H10")->getFont()->setSize(8);

        $this->xls->getActiveSheet()->getRowDimension('11')->setRowHeight(14.25);
        $this->xls->getActiveSheet()->mergeCells('A11:B11');
        $this->xls->getActiveSheet()->setCellValue('A11', 'Следното:');
        $this->xls->getActiveSheet()->getStyle("A11")->getFont()->setSize(10)->setBold(true);
    }

    public function setTable()
    {
        $this->setTableHeader();
        $this->setTableBody();
    }

    public function setTableHeader()
    {
        $this->xls->getActiveSheet()->getRowDimension('12')->setRowHeight(42.75);
        $this->xls->getActiveSheet()->setCellValue('A12', '№:');
        $this->xls->getActiveSheet()->getStyle('A12')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('A12')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->mergeCells('B12:C12');
        $this->xls->getActiveSheet()->setCellValue('B12', 'Наименование');
        $this->xls->getActiveSheet()->getStyle('B12:C12')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('B12:C12')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->mergeCells('D12:E12');
        $this->xls->getActiveSheet()->setCellValue('D12', "Коли-\nчество");
        $this->xls->getActiveSheet()->getStyle('D12:E12')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('D12:E12')->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->setCellValue('F12', 'Материал');
        $this->xls->getActiveSheet()->getStyle('F12')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('F12')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->setCellValue('G12', "Единична \nцена с \nматериала");
        $this->xls->getActiveSheet()->getStyle('G12')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('G12')->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->setCellValue('H12', 'Общо цена');
        $this->xls->getActiveSheet()->getStyle('H12')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('H12')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
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
            $this->xls->getActiveSheet()->getStyle('A' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->mergeCells('B' . $rowCount . ':C' . $rowCount);
            $this->xls->getActiveSheet()->setCellValue('B' . $rowCount, $product->product_name);
            $this->xls->getActiveSheet()->getStyle('B' . $rowCount . ':C' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->mergeCells('D' . $rowCount . ':E' . $rowCount);
            $this->xls->getActiveSheet()->setCellValue('D' . $rowCount, $product->quantity);
            $this->xls->getActiveSheet()->getStyle('D' . $rowCount . ':E' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->setCellValue('F' . $rowCount, $product->material->name);
            $this->xls->getActiveSheet()->getStyle('F' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->setCellValue('G' . $rowCount, $product->single_price_with_material . 'лв');
            $this->xls->getActiveSheet()->getStyle('G' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->setCellValue('H' . $rowCount, $product->price_with_dds . 'лв');
            $this->xls->getActiveSheet()->getStyle('H' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);

            $totalPrice += floatval($product->price_with_dds);
            $rowCount++;
            $displayCount++;
        }

        $this->xls->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(10);

        $this->xls->getActiveSheet()->mergeCells('A' . ($rowCount + 1) . ':B' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('A' . ($rowCount + 1), 'ПРЕДАЛ:');
        $this->xls->getActiveSheet()->getStyle('A' . ($rowCount + 1) . ':B' . ($rowCount + 1))->getFont()->setSize(12)->setUnderline(true)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('A' . ($rowCount + 1) . ':B' . ($rowCount + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->mergeCells('G' . ($rowCount) . ':G' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('G' . $rowCount, 'Всичко:');
        $this->xls->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->getStyle('G' . $rowCount . ':G' . ($rowCount + 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->mergeCells('H' . ($rowCount) . ':H' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('H' . $rowCount, $totalPrice . 'лв');
        $this->xls->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->getStyle('H' . $rowCount . ':H' . ($rowCount + 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);

        $this->xls->getActiveSheet()->getRowDimension($rowCount + 2)->setRowHeight(10);
        $this->xls->getActiveSheet()->mergeCells('C' . ($rowCount + 2) . ':D' . ($rowCount + 2));
        $this->xls->getActiveSheet()->setCellValue('C' . ($rowCount + 2), '(фамилия, подпис)');
        $this->xls->getActiveSheet()->getStyle('C' . ($rowCount + 2) . ':D' . ($rowCount + 2))->getFont()->setSize(8);
        $this->xls->getActiveSheet()->getStyle('C' . ($rowCount + 2) . ':D' . ($rowCount + 2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $this->xls->getActiveSheet()->getRowDimension($rowCount + 3)->setRowHeight(6.75);

        $this->xls->getActiveSheet()->mergeCells('A' . ($rowCount + 4) . ':B' . ($rowCount + 4));
        $this->xls->getActiveSheet()->setCellValue('A' . ($rowCount + 4), 'ПРИЕЛ:');
        $this->xls->getActiveSheet()->getStyle('A' . ($rowCount + 4) . ':B' . ($rowCount + 4))->getFont()->setSize(12)->setUnderline(true)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('A' . ($rowCount + 4) . ':B' . ($rowCount + 4))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->getRowDimension($rowCount + 5)->setRowHeight(10);
        $this->xls->getActiveSheet()->mergeCells('C' . ($rowCount + 5) . ':D' . ($rowCount + 5));
        $this->xls->getActiveSheet()->setCellValue('C' . ($rowCount + 5), '(фамилия, подпис)');
        $this->xls->getActiveSheet()->getStyle('C' . ($rowCount + 5) . ':D' . ($rowCount + 5))->getFont()->setSize(8);
        $this->xls->getActiveSheet()->getStyle('C' . ($rowCount + 5) . ':D' . ($rowCount + 5))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }
}