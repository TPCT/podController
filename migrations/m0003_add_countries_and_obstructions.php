<?php

namespace migrations;

use core\Application;
use helpers\PodHelper;

class m0003_add_countries_and_obstructions
{
    public function up(): bool{
        $connector = Application::APP()->database->connector();
        try{
            $connector->beginTransaction();

            $query = "INSERT INTO `countries` (`country_id`, `country_name`) VALUES
                        (0, 'كل المحافظات'),
                        (1, 'القاهره'),
                        (2, 'الاسكندريه'),
                        (3, 'بورسعيد'),
                        (4, 'السويس '),
                        (11, 'دمياط'),
                        (12, 'الدقهلية'),
                        (13, 'الشرقية'),
                        (14, 'القليوبية'),
                        (15, 'كفر الشيخ'),
                        (16, 'الغربية'),
                        (17, 'المنوفية'),
                        (18, 'البحيرة'),
                        (19, 'الاسماعيلية'),
                        (21, 'الجيزة'),
                        (22, 'بني سويف'),
                        (23, 'الفيوم '),
                        (24, 'المنيا'),
                        (25, 'أسيوط'),
                        (26, 'سوهاج'),
                        (27, 'قنا'),
                        (28, 'أسوان'),
                        (29, 'الاقصر'),
                        (31, 'البحر الأحمر'),
                        (32, 'الوادى الجديد'),
                        (33, 'مرسي مطروح'),
                        (34, 'شمال سيناء'),
                        (35, 'جنوب سيناء');
                        ";
            $stmt = $connector->prepare($query);
            $stmt->execute();

            $query = "INSERT INTO `obstructions` (`obstruction_id`, `obstruction_name`) VALUES
                        (13, 'أمراض الدم'),
                        (7, 'اضطراب طيف توحد'),
                        (2, 'الإعاقة البصرية'),
                        (1, 'الإعاقة الحركية'),
                        (4, 'الإعاقة الذهنية'),
                        (3, 'الإعاقة السمعية'),
                        (12, 'القزامة'),
                        (0, 'كل الاعاقات');";
            $stmt = $connector->prepare($query);
            $stmt->execute();

            $connector->commit();
            return True;
        }catch(Exception $e){
            if ($connector->inTransaction())
                $connector->rollBack();
            Application::APP()->error_logger->log(0, $e, __FILE__, __LINE__);
        }
        return False;
    }

    public function down(){
        $connector = Application::APP()->database->connector();
        $connector->exec("TRUNCATE TABLE countries");
        $connector->exec("TRUNCATE TABLE obstructions");
    }
}