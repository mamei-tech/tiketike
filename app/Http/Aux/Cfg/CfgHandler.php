<?php


namespace App\Http\Aux\Cfg;

use Illuminate\Support\Facades\DB;


abstract class CfgHandler
{
    protected $cfgTable = "configraffles";

    // TODO Optimize this if you can
    public function getConfig($key)
    {
        $cfgvalue = DB::table($this->cfgTable)->where('name', $key)->first();
        return $cfgvalue;
    }

    // TODO Optimize this if you can
    public function setConfig($key, $value)
    {
        DB::table($this->cfgTable)
            ->where('name', $key)
            ->update(['value' => $value]);
    }

}