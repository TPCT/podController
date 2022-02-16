<?php

namespace models;

use helpers\Helper;
use helpers\PodHelper;

class FetchersModel extends \core\Model
{
    public string $reset = '';

    function rules(): array
    {
        return [];
    }

    public function fetchCountries(): array
    {
        $query = "SELECT * FROM countries WHERE country_name != 'كل المحافظات'";
        $stmt = $this->prepare($query);
        if ($stmt->execute()){
            $countries = $stmt->fetchAll();
            if ($countries) return $countries;
        }
        $countries = [];
        while (!$countries){
            $countries = PodHelper::getAvailableCountries();
            foreach ($countries as $country_id => $country_value){
                $query = "INSERT INTO countries(country_id, country_name) VALUES(:country_id, :country_name)";
                $stmt = $this->prepare($query);
                $stmt->bindParam(":country_id", $country_id);
                $stmt->bindParam(":country_name", $country_value);
                $stmt->execute();
            }
        }
        return $countries;
    }

    public function fetchObstructions(): array
    {
        $query = "SELECT * FROM obstructions WHERE obstruction_name != 'كل الاعاقات'";
        $stmt = $this->prepare($query);
        if ($stmt->execute()){
            $obstructions = $stmt->fetchAll();
            if ($obstructions) return $obstructions;
        }
        $obstructions = [];
        while (!$obstructions){
            $obstructions = PodHelper::getAvailableObstructions();
            foreach ($obstructions as $obstruction_id => $obstruction_value){
                $query = "INSERT INTO obstructions(obstruction_id, obstruction_name) VALUES(:obstruction_id, :obstruction_name)";
                $stmt = $this->prepare($query);
                $stmt->bindParam(":obstruction_id", $obstruction_id);
                $stmt->bindParam(":obstruction_name", $obstruction_value);
                $stmt->execute();
            }
        }
        return $obstructions;
    }

    public function fetchSettings(): array{
        if (!isset($_SESSION['bot_settings']))
            $_SESSION['bot_settings'] = [];

        $query = "SELECT * FROM bot_settings";
        $stmt = $this->prepare($query);
        $stmt->execute();
        $settings = $stmt->fetchAll();

        $query = "SELECT obstruction_id, obstruction_name FROM obstructions";
        $stmt = $this->prepare($query);
        $stmt->execute();
        $returnAvailableObstructionIds = $stmt->fetchAll();

        $query = "SELECT country_id, country_name FROM countries";
        $stmt = $this->prepare($query);
        $stmt->execute();
        $returnAvailableCountryIds = $stmt->fetchAll();

        $availableCountryIds = [];
        $availableObstructionIds = [];

        foreach($returnAvailableObstructionIds as $availableObstructionId){
            $availableObstructionIds[$availableObstructionId['obstruction_id']] = $availableObstructionId['obstruction_name'];
        }

        foreach($returnAvailableCountryIds as $availableCountryId){
            $availableCountryIds[$availableCountryId['country_id']] = $availableCountryId['country_name'];
        }


        if ($this->reset !== 'true') {
            $tobeAppended = Helper::arrayRecursiveDiff($settings, $_SESSION['bot_settings']);
            $temp = [];
            foreach($tobeAppended as $value) $temp[] = $value;
            $tobeAppended = $temp;
            $temp = [];
            $toBeDeletedSettings = Helper::arrayRecursiveDiff($_SESSION['bot_settings'], $settings);
            foreach ($toBeDeletedSettings as $value) $temp[] = $value;
            $toBeDeletedSettings = $temp;
        }else{
            $tobeAppended = $settings;
            $toBeDeletedSettings = [];
        }


        foreach($tobeAppended as &$setting){
            $obstruction_ids = explode('-', $setting['obstruction_id']);
            $obstruction_names = [];
            foreach($obstruction_ids as $obstruction_id){
                $obstruction_names[] = $availableObstructionIds[(int)$obstruction_id];
            }
            $obstruction_names = implode('-', $obstruction_names);
            $setting['obstruction_names'] = $obstruction_names;
            $setting['country_name'] = $availableCountryIds[(int)$setting['country_id']];
            unset($setting['country_id']);
            unset($setting['obstruction_id']);
        }

        $_SESSION['bot_settings'] = $settings;
        return ['append' => $tobeAppended, 'delete' => $toBeDeletedSettings];
    }
}
