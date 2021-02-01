<?php


namespace Phone;


class PhoneGenerator {
    protected $areaCodesRle="201-210,212-220,223-229,231,234,236,239-240,242,".
    "246,248-254,256,260,262-264,267-270,272,274,276,279,281,283-284,289,".
    "301-310,312-321,323,325-327,330-332,334,336-337,339-341,343,345-347,".
    "351-352,354,360-361,364-365,367-368,380,382,385-387,401-410,412-419,".
    "423-425,428,430-432,434-435,437-438,440-443,445,447-448,450,458,463-464,".
    "468-470,473-475,478-480,484,501-510,512-520,530-531,534,539-541,548,551,".
    "557,559,561-564,567,570-575,579-582,584-587,601-610,612-620,623,626,".
    "628-631,636,639-641,646-647,649-651,656-662,664,667,669-672,678-684,689,".
    "701-709,712-721,724-727,730-732,734,737,740,742-743,747,753-754,757-758,".
    "760,762-763,765,767,769-775,778-782,784-787,801-810,812-820,825-826,".
    "828-832,838-840,843,845,847-850,854,856-860,862-865,867-870,872-873,876,".
    "878-879,901-910,912-920,925,928-931,934,936-943,945,947-949,951-952,954,".
    "956,959,970-973,975,978-980,984-986,989";
    protected $areaCodes,$areaCodesCount;
    function __construct() {
        $this->areaCodes=[];
        foreach (explode(",",$this->areaCodesRle) as $codeRange) {
            if (strpos($codeRange, "-") !== false) {
                $codeRangeInt =
                array_map(function ($s) {return (int)$s;},
                    explode("-",$codeRange)
                );
                foreach (range($codeRangeInt[0],$codeRangeInt[1]) as $code) {
                    $this->areaCodes[]=$code;
                }
            } else {
                $this->areaCodes[]=(int)$codeRange;
            }
        }
        $this->areaCodesCount = count($this->areaCodes);
    }

    function getRandom() {
        return sprintf("+1%03d%07d",
            $this->areaCodes[mt_rand(0,$this->areaCodesCount-1)],
            mt_rand()%((int)1e7)
        );
    }
}