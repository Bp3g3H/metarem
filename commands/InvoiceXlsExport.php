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
 * @property $order Order
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
        $this->xls->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
        $this->xls->getActiveSheet()->mergeCells('D5:E5');
        $this->xls->getActiveSheet()->mergeCells('F5:H5');
        $this->xls->getActiveSheet()->setCellValue('F5', date('d-m-Y') . 'г');
        $this->xls->getActiveSheet()->getStyle("F5:H5")->getFont()->setSize(16)->setBold(true);
        $this->xls->getActiveSheet()->getStyle('F5:H5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $this->xls->getActiveSheet()->getRowDimension('6')->setRowHeight(10);

        $this->xls->getActiveSheet()->mergeCells('A7:C7');
        $this->xls->getActiveSheet()->setCellValue('A7', 'Подписаният:');
        $this->xls->getActiveSheet()->getStyle('A7:C7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->getRowDimension('8')->setRowHeight(10);
        $this->xls->getActiveSheet()->mergeCells('D8:H8');
        $this->xls->getActiveSheet()->setCellValue('D8', '(име, фамилия, длъжност)');
        $this->xls->getActiveSheet()->getStyle("D8:H8")->getFont()->setSize(9);

        $this->xls->getActiveSheet()->mergeCells('A9:C9');
        $this->xls->getActiveSheet()->setCellValue('A9', 'Предадох на:');
        $this->xls->getActiveSheet()->getStyle('A9:C9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $this->xls->getActiveSheet()->getRowDimension('10')->setRowHeight(10);
        $this->xls->getActiveSheet()->mergeCells('D10:H10');
        $this->xls->getActiveSheet()->setCellValue('D10', '(име, фамилия, длъжност)');
        $this->xls->getActiveSheet()->getStyle("D10:H10")->getFont()->setSize(9);

        $this->xls->getActiveSheet()->mergeCells('A11:B11');
        $this->xls->getActiveSheet()->setCellValue('A11', 'Следното:');

    }


}