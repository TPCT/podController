<?php

namespace helpers;


class PodHelper
{
    const URL = "http://pod.mohp.gov.eg/InqDate.aspx";

    public static function getAvailableObstructions(): array{
        $result = ['countries' => [], 'obstructions' => []];
        while(!$result['countries'] || !$result['obstructions']){
            $handler = curl_init(self::URL);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, True);
            curl_setopt($handler, CURLOPT_POST, 1);
            curl_setopt($handler, CURLOPT_POSTFIELDS, "__VIEWSTATEENCRYPTED=&__EVENTARGUMENT=&__LASTFOCUS=&__ASYNCPOST=true&__VIEWSTATE=n8C8d7LbId5sLEP9WF4Jo4Iqck%2FkLuXpIdZ1zx6xgoeLaJw3TXUzAKoBW8qW2h0FPmZ6xuat2H3UdABqa0JdKxbcz8iuqNd5SwtTxh3cEnIh5rYyVZFYcke0%2F99gOn5Ydr2XIDPFVcXc2h5KuggwshHBfO%2BaPoEiHre0hJY5AYd%2BQT3bwmj8UU5E3NF5SxhxbdgfiYK0rmAXK3YMvAQWkL3%2B%2BrXOpC3rZTqcZOQjD7sGhQAPiOY86RSS4BVv1htbuA7dmoixWi32M2odrmz%2BETIZBBD%2F2lXhzG3JfaVS9I0Hm0dADkW49PMW4WJDQaNj6oXZ2Mg6x08sjEtCPCakJa%2BVIO%2F8BK5GXGu3MSBIDbYmtCKkLKUeijU1fH6fQ3FCv57ecU18iHXIiy9otePoq2Z4ipENgYgKgj4m7wervkiYr%2BJqlVCiafRz344%2F9p%2Bl8v2sgtjgnlm0Bxt7wF3ASjN%2BKKFSGcCX0zLniJwq2EHSoZr8s%2FyRtsEh2O7fRdQjvhCZCGDaPDiOV1I%2F8IQu16Lp6xnDqJDybkIoj8CTCo5YYlQLpJvJL0XtNjBOrDOnfYyTUHE0TFkc%2BEn6gm4CUBqUO2St4cWnY9tM%2F1GjQuwjM%2FlTnhT6vXez14u8TPuBeB3vICuOzrTP6X2UBxEkERW3ar%2BTDowjMPmZdO9EoW7sOvBRyuSdm4ZG9W37vnapRqPT2LNeYHz8TmgR7B0q1RLPWUtKjzDyTkNXE10MkVpZN8Ysju6TQf1dO%2F1ua%2BwTk3E4YqO9x4hLnGCzZA8W8Bi1DzCFzdDC7Gut%2BSM64Kz8c0igg9yUFI0x2%2B4KbCwnQ6E%2BA0cgv8op6wse9y8vGYngQdL8v71Qzk9mcjLb%2BGg%2FkcPcvaVljEexzVoiQ8etaXYquNclnkmq5BQS77pggxVBhkYVF5DYGTAsw8w1alGKfvjq58AK%2BXMgCVpM0rQG2sG9s7pSCoTtmLSu0DGjzIMVUKLVsI9iMulKeTNUVaVegwoXZDtOlsfk%2BH377Cpt&__EVENTVALIDATION=VlFqq2kXfKqzNXc8Y0RcROWxbyaSvw%2FuASI%2B0CoQ9aIeb3%2BuUJHujWGAirJxuuLiYTlv5FaRMGQDOf2UYQWP2SO2zVmLxWbfwjUrsmMhpNd0JpcTwsbG%2BFBt2iRGI0f%2BYsSvfpJ7Xh6OoVQJ1AGUeWbt5WZfrPUWwlJGFqIjvrNznkePv3xFXphIzZR%2BQzslNcEJ8RU8b3Us9MEDXubXYpufJXpoBaSCR5FWsgune4vu6w2PgrUSttV0c%2Bpa%2FocC0M9g1SmL8xJ11qTaLD%2BYU7S9HlKgCS%2BY3dk3JcwJRAzY0IBhaVMuqPksWVJ8h%2B0jjoD2zwGsNyw9nTFr9%2BZFaOnXKK3hdpztEY%2FhXM5GaqPBjiU6WRzEeMAbcH3SYU64GZpYvddWigESQxaeFv%2Fv%2BxRoreTNIw2exCKUJjrp%2Bttat3HecRIFjTwGTghFNeQz10rSjRHirbwFv%2BDOIgIi2lAJPDYyDxRdo5JhbI6NSalRwSu0oFJrIDBsaMAi65JkeQdvN%2BO9J3Kx6jcW3FUmCrVLvTxH%2BoQLqBT5tzBClXYw6ZCuLCxoYQHYIfxzTDxWRjmVSrzmbrQxVdN0N6Xs12BFKD0nGe9ixT0ZrIWTpMD5xwWlJEn7JXKJYikQR2xJrxoHB2ZIiD%2Fj%2B%2BLh0JpGHDpOcn%2Bch5K2oq9L7oIVp6ecal5r%2BXguKm7wE%2FXaouZek8DKtGPJVQylQTbQyb5J0w%3D%3D&ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel2%7Cctl00%24ContentPlaceHolder1%24ddlGovernorate&=&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlGovernorate&ctl00%24ContentPlaceHolder1%24ddlGovernorate=1");
            curl_setopt($handler, CURLOPT_HTTPHEADER, array(
                'Accept-Language: en-US,en;q=0.9',
                'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.80 Safari/537.36',
                'X-MicrosoftAjax: Delta=true',
                'X-Requested-With: XMLHttpRequest'
            ));
            $response = curl_exec($handler);
            if (!$response || curl_getinfo($handler, CURLINFO_HTTP_CODE !== 200)) continue;
            curl_close($handler);
            $parser = new \DOMDocument();
            @$parser->loadHTML(mb_convert_encoding($response, 'HTML-ENTITIES', 'UTF-8'));
            $counties = $parser->getElementById("ContentPlaceHolder1_ddlGovernorate")
                ->getElementsByTagName("option");
            foreach($counties as $country){
                if ($country->getAttribute('value') == 0) continue;
                $result['countries'][$country->getAttribute('value')] = $country->textContent;
            }
            $obstructions = $parser->getElementById("ContentPlaceHolder1_ddlSp")
                ->getElementsByTagName("option");
            foreach($obstructions as $obstruction){
                if ($obstruction->getAttribute('value') == 0) continue;
                $result['obstructions'][$obstruction->getAttribute('value')] = $obstruction->textContent;
            }
        }
        return $result;
    }

}