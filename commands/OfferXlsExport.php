<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/4/2018
 * Time: 10:31 AM
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
class OfferXlsExport implements ExcelExport
{
    public $order;
    public $xls;
    public $rowCount = 1;

    function loadData($order)
    {
        $this->order = $order;
        $this->xls = new Spreadsheet();
    }

    function export()
    {
        $this->xls->getProperties()->setTitle("Activities");
        $this->xls->setActiveSheetIndex(0);
        $this->setStyleOptions();
        $this->setHeader();
        $this->setTable();

        return $this->xls;
    }

    function setStyleOptions()
    {
        $this->xls->getActiveSheet()->setShowGridlines(false);
        $this->xls->getDefaultStyle()->getFont()->setName('Arial');
        $this->xls->getActiveSheet()->getColumnDimension('A')->setWidth(2.29);
        $this->xls->getActiveSheet()->getColumnDimension('B')->setWidth(42.14);
        $this->xls->getActiveSheet()->getColumnDimension('C')->setWidth(8.14);
        $this->xls->getActiveSheet()->getColumnDimension('D')->setWidth(20.71);
        $this->xls->getActiveSheet()->getColumnDimension('E')->setWidth(9.71);
        $this->xls->getActiveSheet()->getColumnDimension('F')->setWidth(12);
    }

    function setHeader()
    {
        $this->xls->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $this->xls->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $drawing = new HeaderFooterDrawing();
        $drawing->setName('PhpSpreadsheet logo');
        $drawing->setCoordinates('A1');
        $drawing->setPath(\Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'metarempng.png');
        $drawing->setWorksheet($this->xls->getActiveSheet());

        $this->xls->getActiveSheet()->getRowDimension('3')->setRowHeight(10);

        $this->xls->getActiveSheet()->setCellValue('B4', '№');
        $this->xls->getActiveSheet()->getStyle("B4")->getFont()->setSize(14)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $this->xls->getActiveSheet()->setCellValue('C4', $this->order->id);
        $this->xls->getActiveSheet()->getStyle("C4")->getFont()->setSize(14)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $this->xls->getActiveSheet()->getRowDimension('4')->setRowHeight(18);
        $this->xls->getActiveSheet()->mergeCells('D4:F4');
        $this->xls->getActiveSheet()->setCellValue('D4', date('d-m-Y') . 'г');
        $this->xls->getActiveSheet()->getStyle("D4:F4")->getFont()->setSize(14)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('D4:F4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $this->xls->getActiveSheet()->getRowDimension('5')->setRowHeight(10);

        $this->xls->getActiveSheet()->getRowDimension('6')->setRowHeight(15.75);
        $this->xls->getActiveSheet()->mergeCells('A6:B6');
        $this->xls->getActiveSheet()->setCellValue('A6', 'Оферта за лазерно рязане на:');
        $this->xls->getActiveSheet()->getStyle("A6:B6")->getFont()->setSize(12)->setBold(true);

        $this->xls->getActiveSheet()->getRowDimension('7')->setRowHeight(14.25);

    }

    public function setTable()
    {
        $this->setTableHeader();
        $this->setTableBody();
    }

    public function setTableHeader()
    {
        $this->xls->getActiveSheet()->getRowDimension('8')->setRowHeight(42.75);
        $this->xls->getActiveSheet()->setCellValue('A8', '№:');
        $this->xls->getActiveSheet()->getStyle('A8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('A8')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->setCellValue('B8', 'Наименование');
        $this->xls->getActiveSheet()->getStyle('B8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('B8')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->setCellValue('C8', "Коли-\nчество");
        $this->xls->getActiveSheet()->getStyle('C8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('C8')->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->setCellValue('D8', 'Материал');
        $this->xls->getActiveSheet()->getStyle('D8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('D8')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->setCellValue('E8', "Единична \nцена с \nматериала");
        $this->xls->getActiveSheet()->getStyle('E8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('E8')->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->setCellValue('F8', 'Общо цена');
        $this->xls->getActiveSheet()->getStyle('F8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->getStyle('F8')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    public function setTableBody()
    {
        $products = $this->order->products;
        $displayCount = 1;
        $rowCount = 9;
        $totalPrice = 0;
        foreach ($products as $product)
        {

            $this->xls->getActiveSheet()->setCellValue('A' . $rowCount, $displayCount);
            $this->xls->getActiveSheet()->getStyle('A' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->getStyle('A' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->xls->getActiveSheet()->setCellValue('B' . $rowCount, $product->product_name);
            $this->xls->getActiveSheet()->getStyle('B' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->getStyle('B' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->xls->getActiveSheet()->setCellValue('C' . $rowCount, $product->quantity);
            $this->xls->getActiveSheet()->getStyle('C' . $rowCount . ':E' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->getStyle('C' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->xls->getActiveSheet()->setCellValue('D' . $rowCount, $product->material->name);
            $this->xls->getActiveSheet()->getStyle('D' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->getStyle('D' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->xls->getActiveSheet()->setCellValue('E' . $rowCount, $product->single_price_with_material . 'лв');
            $this->xls->getActiveSheet()->getStyle('E' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->getStyle('E' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $this->xls->getActiveSheet()->setCellValue('F' . $rowCount, $product->full_price . 'лв');
            $this->xls->getActiveSheet()->getStyle('F' . $rowCount)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
            $this->xls->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $totalPrice += floatval($product->price_with_dds);
            $rowCount++;
            $displayCount++;
        }

        $this->xls->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(10);

        $this->xls->getActiveSheet()->getRowDimension($rowCount + 1)->setRowHeight(16.5);
        $this->xls->getActiveSheet()->mergeCells('B' . ($rowCount + 1) . ':D' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('B' . ($rowCount + 1), 'Цените са без ДДС');
        $this->xls->getActiveSheet()->getStyle('B' . ($rowCount + 1) . ':D' . ($rowCount + 1))->getFont()->setSize(12)->setBold(true);

        $this->xls->getActiveSheet()->mergeCells('E' . ($rowCount) . ':E' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('E' . $rowCount, 'Всичко:');
        $this->xls->getActiveSheet()->getStyle('E' . $rowCount)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->getStyle('E' . $rowCount . ':E' . ($rowCount + 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
        $this->xls->getActiveSheet()->mergeCells('F' . ($rowCount) . ':F' . ($rowCount + 1));
        $this->xls->getActiveSheet()->setCellValue('F' . $rowCount, $totalPrice . 'лв');
        $this->xls->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->xls->getActiveSheet()->getStyle('F' . $rowCount . ':F' . ($rowCount + 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);

    }
}