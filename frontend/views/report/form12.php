<?php
/* @var $this yii\web\View */

//use yii\jui\DatePicker;
use kartik\datecontrol\Module;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;

$this->title = 'MIS :: ระบบรายงานสารสนเทศ';
?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3></h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4><a href="void(0)" onclick = "javascript:(history.go(-1))">หน้าหลัก</a> >> 
                        <?php echo $report_name; ?>
                    </h4>
                    <div class="clearfix"></div>
                </div>

                <br>
                <form novalidate="" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">
                  
                    <div class="form-group">

                        <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3">
                            <select id="year" class="form-control">
                                <option value="">กรุณาเลือกปีงบประมาณ</option>
                                <option value="2555">2555</option>
                                <option value="2556">2556</option>
                                <option value="2557">2557</option>
                                <option value="2558">2558</option>
                                <option value="2559">2559</option>
                                <option value="2560">2560</option>
                                <option value="2561">2561</option>
                                <option value="2562">2562</option>
                                <option value="2563">2563</option>
                                <option value="2564">2564</option>
                                <option value="2565">2565</option>
                                <option value="2566">2566</option>
                                <option value="2567">2567</option>
                                <option value="2568">2568</option>
                                <option value="2569">2569</option>
                                <option value="2570">2570</option>
                                <option value="2571">2571</option>
                                <option value="2572">2572</option>
                                <option value="2573">2573</option>
                                <option value="2574">2574</option>
                                <option value="2575">2575</option>
                                
                            </select> 
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="button" class="btn btn-primary" onclick = "javascript:url()"><i class="fa fa-search"></i> ค้นหา</button>
                            <button type="button" class="btn btn-success" onclick = "javascript:(history.go(-1))">ย้อนกลับ</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    //function เรียกหน้ารายงาน
    function url() {

        // Get ค่าจากกล่องเลือกประเภท user
        var e = document.getElementById("year");
        var begin_year = e.options[e.selectedIndex].value;
        //var datestart = document.getElementById("datestart").value;
        //var dateend = document.getElementById("dateend").value;

        //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
         //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
        
        if(begin_year == "") {
            alert("กรุณาเลือกปีงบประมาณด้วยครับ");
            return false;
        }
       window.open('http://192.168.1.252:8080/mis/frontend/web/index.php?r=<?= $ctrl ?>/<?= $point ?>&begin_year=' + begin_year + '&details=<?= $details; ?>');
    }



    window.onload = function () {
        //your jQuery code here
        // jquery here     
    };


</script>
