<?php


namespace App\Http\TkTk\Cfg;

use Illuminate\Support\Facades\DB;


abstract class CfgHandler
{
    protected $cfgTable = "configraffles";
    public function getConfig($key)
    {
        $cfgvalue = DB::table($this->cfgTable)->where('name', $key)->first();
        return $cfgvalue;
    }

    public function setConfig($key, $value)
    {
        DB::table($this->cfgTable)
            ->where('name', $key)
            ->update(['value' => $value]);
    }

}