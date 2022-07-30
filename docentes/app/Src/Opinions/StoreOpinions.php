<?php

namespace App\Src\Opinions;

use App\Models\Opinion;

class StoreOpinions{

    public function handle(Opinion $opinion){
        $opinion->save();
    }

}

?>
