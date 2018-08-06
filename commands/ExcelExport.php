<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/4/2018
 * Time: 10:33 AM
 */

namespace app\commands;


interface ExcelExport
{
    function loadData($order);
    function export();
    function setStyleOptions();
    function setHeader();
    function setTable();
}