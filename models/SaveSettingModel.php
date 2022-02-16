<?php

namespace models;

class SaveSettingModel extends \core\Model
{
    public string $name = '';
    public string $channel = '';
    public string $bot = '';
    public string $country = '';
    public array $obstructions = [];

    #[ArrayShape(['name' => "array", 'channel' => "array", 'bot' => "array", 'country' => "array", 'obstructions' => "array"])]
    function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'channel' => [self::RULE_REQUIRED],
            'bot' => [self::RULE_REQUIRED],
            'country' => [self::RULE_REQUIRED],
            'obstructions' => [self::RULE_REQUIRED]
        ];
    }

    function save():bool{
        try{
            $query = "INSERT INTO bot_settings(setting_name, telegram_bot, 
                                           telegram_channel, country_id, 
                                           obstruction_id
                                           ) 
                  VALUES (:setting_name, :telegram_bot, :telegram_channel, :country_id, :obstruction_ids)";
            $stmt = $this->prepare($query);
            $obstruction_names = implode('-', $this->obstructions);
            $stmt->bindParam(":setting_name", $this->name);
            $stmt->bindParam(":telegram_bot", $this->bot);
            $stmt->bindParam(":telegram_channel", $this->channel);
            $stmt->bindParam(":country_id", $this->country);
            $stmt->bindParam(":obstruction_ids", $obstruction_names);
            return $stmt->execute();
        }catch (\Exception $e){
            var_dump($e);
            return False;
        }
    }
}