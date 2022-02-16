<?php

namespace models;

class DeleteSettingModel extends \core\Model
{
    public string $id = '';
    function rules(): array
    {
        return [
            'id' => [self::RULE_REQUIRED]
        ];
    }

    public function delete(){
        $query = "DELETE FROM bot_settings WHERE id=:id";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

}