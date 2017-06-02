<?php

/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = $report_name;
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'heading' => $report_name,
        'before' => $details,
        'type' => 'primary',
        'after' => 'ประมวลผล ณ วันที่ ' . date('Y-m-d H:i:s')
    ],
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
    
        [
            'attribute' => 'vstdate',
            'header' => 'ว/ด/ป ที่ลงทะเบียน'
        ],
         [
            'attribute' => 'hospmain',
            'header' => 'รหัสหน่วยงาน'
        ],
          [
            'attribute' => 'cid',
            'header' => 'เลขบัตรประจำตัว'
        ],
          [
            'attribute' => 'pname',
            'header' => 'คำนำหน้า'
        ],
        
        [
            'attribute' => 'pt_name',
            'header' => 'ชื่อ-สกุล'
        ],
        [
            'attribute' => 'birthday',
            'header' => 'วันเกิด'
        ],
        [
            'attribute' => 'nation_name',
            'header' => 'เชื้อชาติ'
        ],
        [
            'attribute' => 'type_name',
            'header' => 'ประเภท'
        ],
        [
            'attribute' => 'sex_name',
            'header' => 'เพศ'
        ],
        [
            'attribute' => 'informaddr',
            'header' => 'ที่อยู่'
        ],
        [
            'attribute' => 'informname',
            'header' => 'นายจ้าง'
        ],
       
        [
            'attribute' => 'hometel',
            'header' => 'เบอร์โทรศัพท์'
        ],
        [
            'attribute' => 'doc_name',
            'header' => 'แพทย์ผู้ตรวจ'
        ],
        [
            'attribute' => 'startexam',
            'header' => 'เวลาแพทย์เริ่มตรวจ'
        ],
       
          
    ]
])
?>

