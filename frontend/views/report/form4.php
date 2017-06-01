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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ช่วงวันที่ <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <?php
                            echo DatePicker::widget([
                                'name' => 'from_date',
                                'type' => DatePicker::TYPE_RANGE,
                                'name2' => 'to_date',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ]
                            ]);
                            ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3">
                            <select id="clinic" class="form-control">
                                <option value="">กรุณาเลือกประเภทคนไข้ในคลินิก</option>
                                <option value="1">คนไข้ DM อย่างเดียว</option>
                                <option value="2">คนไข้ DM WITH HT</option>
                                <option value="3">คนไข้ DM ทั้งหมด</option>
                            </select> 
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3">
                            <select id="lab_items" class="form-control">
                                <option value="">กรุณาระบุชนิดแลป</option>
                                <option value="1">HbA1C</option>
                                <option value="2">eGFR</option>
                                <option value="3">Urine Protein</option>
                                <option value="4">Microalbumin</option>
                                <option value="5">Lipid Profile</option>
                                <option value="6">Creatinine</option>
                              
                            </select> 
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3">
                            <select id="operators" class="form-control">
                                <option value="">ไม่ระบุเงื่อนไข</option>
                                <option value=">">มากกว่า</option>
                                <option value=">=">มากกว่าหรือเท่ากับ</option>
                                <option value="<">น้อยกว่า</option>
                                <option value="<=">น้อยกว่าหรือเท่ากับ</option>
                            </select> 
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3">
                            <select id="result_first" class="form-control">
                                <option value="">ไม่ระบุผลข้อมูล</option>
                                <?php for ($i = 1; $i <= 180; ++$i) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>                             
                            </select> 
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-3">
                            <select id="drug_items" class="form-control">
                                <option value="">ไม่ระบุเงื่อนไขเกี่ยวกับยา</option>
                                <option value="1">ยาชะลอไต</option>
                                <option value="2">ยาห้ามใช้ในผู้ป่วยไตวาย(metformin)</option>
                                <option value="3">ยาห้ามใช้ในผู้ป่วยไตวาย(gliben)</option>
                                <option value="4">ยาห้ามใช้ในผู้ป่วยไตวาย(glipizide)</option>
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
        var e = document.getElementById("clinic");
        var uclinic = e.options[e.selectedIndex].value;

        var o = document.getElementById("operators");
        var operators = o.options[o.selectedIndex].value;

        var r = document.getElementById("result_first");
        var result_first = r.options[r.selectedIndex].value;

        var l = document.getElementById("lab_items");
        var lab_items = l.options[l.selectedIndex].value;

        var d = document.getElementById("drug_items");
        var drug_items = d.options[d.selectedIndex].value;

        // var datestart = document.getElementById("w0").value;
        // var dateend = document.getElementById("w0-2").value;

        //ตัดเครื่องหมาย - ออก แล้วส่ง datestart&dateend ไปยัง url ที่ต้องการ
        d1 = $('#w0').val();
        var arr1 = d1.split("-");
        s1 = arr1[0];
        s2 = arr1[1];
        s3 = arr1[2] - 543;
        datestart = s3 + s2 + s1;


        d2 = $('#w0-2').val();
        var arr2 = d2.split("-");
        m1 = arr2[0];
        m2 = arr2[1];
        m3 = arr2[2] - 543;
        dateend = m3 + m2 + m1;

        window.open('http://192.168.1.252:8080/mis/frontend/web/index.php?r=<?= $ctrl ?>/<?= $point ?>&uclinic=' + uclinic + '&datestart=' + datestart + '&dateend=' + dateend + '&details=<?= $details; ?>' + '&operators=' + operators + '&result_first=' + result_first + '&lab_items=' + lab_items + '&drug_items=' + drug_items);
    }




    window.onload = function () {
        //your jQuery code here
        // jquery here     
    };


</script>
