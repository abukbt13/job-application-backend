<?php

use App\Models\Log;

function storelog($acti, $fghjk, $fgh){
    Log::create([
        'activity' => $acti,
        'user_id' => $fghjk,
        'platform'=>$fgh,
    ]);
}
