<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Configuration;

return new class extends Migration
{

    private function seedConfigs(String $json, String $identifier, String $componentList)
    {

        $config = new Configuration();
        $config->configuration = $json;
        $config->identifier = $identifier;
        $config->componentList = $componentList;
        $config->save();
    }

    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable()->default(null);
            $table->text('color')->nullable()->default(null);;
            $table->text('configuration');
            $table->text('identifier');
            $table->text('componentList')->nullable();
        });

        $json = '{"models":[{"url":"\/assets\/dawn\/CHAISE_RIGHT\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":0},"rotation":{"x":0,"y":3.141592653589793,"z":0},"side":"rightCorner","firstModelPlaced":true,"type":false,"idString":"J3qcuEe"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.8416112788095136,"y":0,"z":-4.023372671771262},"rotation":{"x":0,"y":0,"z":0},"side":"rightCorner","firstModelPlaced":false,"type":false,"idString":"wgdlFoY"}],"componentIds":[9,1]}';
        $identifier = '647919b887';
        $componentList = '[9,1]';
        $this->seedConfigs($json, $identifier, $componentList);
        $json2 = '{"models":[{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.3596888125751323,"y":0,"z":-2.2011010786161918},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":true,"type":true,"idString":"EpdP7p3"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.47165432016975667,"y":0,"z":2.264675494455579},"rotation":{"x":0,"y":4.71238898038469,"z":0},"side":"right","firstModelPlaced":false,"type":true,"idString":"RNUnc42"}],"componentIds":[13,13]}';
        $identifier2 = '64791aa132';
        $componentList2 = '[13,13]';
        $this->seedConfigs($json2, $identifier2, $componentList2);
        $json = '{"models":[{"url":"\/assets\/dawn\/CHAISE_RIGHT\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":0},"rotation":{"x":0,"y":3.141592653589793,"z":0},"side":"rightCorner","firstModelPlaced":true,"type":false,"idString":"J3qcuEe"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.8416112788095136,"y":0,"z":-4.023372671771262},"rotation":{"x":0,"y":0,"z":0},"side":"rightCorner","firstModelPlaced":false,"type":false,"idString":"wgdlFoY"}],"componentIds":[9,1]}';
        $id = '647919b887';
        $list = '[9,1]';
        $this->seedConfigs($json, $id, $list);
        $json = '{"models":[{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":0},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":true,"type":false,"idString":"ibfkEa2"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.21914031418881041,"y":0,"z":-4.28798840729568},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":false,"type":true,"idString":"4akrN7Z"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.037415948264493265,"y":0,"z":4.162250426414769},"rotation":{"x":0,"y":-1.5707963267948966,"z":0},"side":"right","firstModelPlaced":false,"type":true,"idString":"BgNBzvv"}],"componentIds":[1,13,13]}';
        $id = '64792027e3';
        $list = '[1,13,13]';
        $this->seedConfigs($json, $id, $list);
        $json = '{"models":[{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":0},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":true,"type":false,"idString":"himTiBP"},{"url":"\/assets\/dawn\/CHAISE_LEFT\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-2.351953238248825,"y":0,"z":-4.07093016116918},"rotation":{"x":0,"y":0,"z":0},"side":"leftCorner","firstModelPlaced":false,"type":false,"idString":"5IJdBsn"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.08138908869994907,"y":0,"z":4.253516845279616},"rotation":{"x":0,"y":4.71238898038469,"z":0},"side":"leftCorner","firstModelPlaced":false,"type":true,"idString":"JU6FUun"}],"componentIds":[1,5,13]}';
        $id = '647920b469';
        $list = '[1,5,13]';
        $this->seedConfigs($json, $id, $list);
        $json = '{"models":[{"url":"\/assets\/dawn\/CHAISE_LEFT\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":0},"rotation":{"x":0,"y":0,"z":0},"side":"leftCorner","firstModelPlaced":true,"type":false,"idString":"QfWZT30"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":2.2942579154130542,"y":0,"z":4.301357962036809},"rotation":{"x":0,"y":0,"z":0},"side":"leftCorner","firstModelPlaced":false,"type":false,"idString":"4LB2bK0"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":2.2886578728148574,"y":0,"z":8.261573281708928},"rotation":{"x":0,"y":0,"z":0},"side":"leftCorner","firstModelPlaced":false,"type":false,"idString":"4jYuuCQ"}],"componentIds":[5,1,1]}';
        $id = '6479210e62';
        $list = '[5,1,1]';
        $this->seedConfigs($json, $id, $list);
        $json = '{"models":[{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":0},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":true,"type":false,"idString":"PdXypB5"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":4.07093016116918},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":false,"type":false,"idString":"AyODBQG"},{"url":"\/assets\/dawn\/CHAISE_RIGHT\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-2.351953238248825,"y":0,"z":8.14186032233836},"rotation":{"x":0,"y":-3.141592653589793,"z":0},"side":"rightCorner","firstModelPlaced":false,"type":false,"idString":"TPcx63t"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.008677616871590263,"y":0,"z":-4.345309403590361},"rotation":{"x":0,"y":0,"z":0},"side":"rightCorner","firstModelPlaced":false,"type":true,"idString":"Pvnvp7I"}],"componentIds":[1,1,9,13]}';
        $id = '647921baee';
        $list = '[1,1,9,13]';
        $this->seedConfigs($json, $id, $list);
        $json = '{"models":[{"url":"\/assets\/dawn\/CHAISE_LEFT\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-2.000681286233734,"y":0,"z":-8.52143934746326},"rotation":{"x":0,"y":0,"z":0},"side":"leftCorner","firstModelPlaced":true,"type":false,"idString":"sOrnyAp"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.1604391175428912,"y":0,"z":-4.22043103399428},"rotation":{"x":0,"y":0,"z":0},"side":"leftCorner","firstModelPlaced":false,"type":false,"idString":"Fmc4OOd"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.2922808092014604,"y":0,"z":-0.24561779534758155},"rotation":{"x":0,"y":0,"z":0},"side":"leftCorner","firstModelPlaced":false,"type":false,"idString":"kJ7JL9D"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0.33637322054586666,"y":0,"z":3.9880146426089467},"rotation":{"x":0,"y":4.71238898038469,"z":0},"side":"leftCorner","firstModelPlaced":false,"type":true,"idString":"qm7afhc"}],"componentIds":[5,1,1,13]}';
        $id = '647922521e';
        $list = '[5,1,1,13]';
        $this->seedConfigs($json, $id, $list);
        $json = '{"models":[{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":0},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":true,"type":false,"idString":"gFfOYtS"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":4.07093016116918},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":false,"type":false,"idString":"4AqWXFQ"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.0020168780949525456,"y":0,"z":-4.200118347819903},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":false,"type":true,"idString":"eUFHpoU"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-4.217833162857125,"y":0,"z":-4.195292570313755},"rotation":{"x":0,"y":-4.71238898038469,"z":0},"side":"right","firstModelPlaced":false,"type":false,"idString":"IJJjZn2"}],"componentIds":[1,1,13,1]}';
        $id = '647922b7f1';
        $list = '[1,1,13,1]';
        $this->seedConfigs($json, $id, $list);
        $json = '{"models":[{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.44845773680481926,"y":0,"z":-5.890119127854265},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":true,"type":false,"idString":"bI51RQz"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.4201547640894693,"y":0,"z":-1.8489322729108075},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":false,"type":false,"idString":"SdV9NQ7"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.3973679900506895,"y":0,"z":2.3751448410327503},"rotation":{"x":0,"y":-1.5707963267948966,"z":0},"side":"right","firstModelPlaced":false,"type":true,"idString":"zui5u2T"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.45242497826454675,"y":0,"z":-10.204288846574531},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":false,"type":true,"idString":"vZvW6eF"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-4.754762225290704,"y":0,"z":-10.342271194013708},"rotation":{"x":0,"y":-4.71238898038469,"z":0},"side":"right","firstModelPlaced":false,"type":false,"idString":"nSfdkmb"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-4.572675123369356,"y":0,"z":2.4318836379385385},"rotation":{"x":0,"y":-1.5707963267948966,"z":0},"side":"right","firstModelPlaced":false,"type":false,"idString":"Rh0Q5KC"}],"componentIds":[1,1,13,13,1,1]}';
        $id = '6479236596';
        $list = '[1,1,13,13,1,1]';
        $this->seedConfigs($json, $id, $list);
        $json = '{"models":[{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":0,"y":0,"z":0},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":true,"type":false,"idString":"bPa9j8e"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.010362305520337234,"y":0,"z":-4.022554508275559},"rotation":{"x":0,"y":0,"z":0},"side":"right","firstModelPlaced":false,"type":false,"idString":"K51lISQ"},{"url":"\/assets\/dawn\/CHAISE_RIGHT\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-2.2639174050227933,"y":0,"z":4.258169162878571},"rotation":{"x":0,"y":-3.141592653589793,"z":0},"side":"rightCorner","firstModelPlaced":false,"type":false,"idString":"kGh6gdH"},{"url":"\/assets\/dawn\/CORNER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-0.02802102982856409,"y":0,"z":-8.280038551391446},"rotation":{"x":0,"y":-6.283185307179586,"z":0},"side":"rightCorner","firstModelPlaced":false,"type":true,"idString":"EUtjgil"},{"url":"\/assets\/dawn\/1_SEATER\/BLACK_177_OLENA_LIGHT_GREY.glb","position":{"x":-4.2531240279031834,"y":0,"z":-8.343912312914188},"rotation":{"x":0,"y":-4.71238898038469,"z":0},"side":"rightCorner","firstModelPlaced":false,"type":false,"idString":"xXCo0VV"}],"componentIds":[1,1,9,13,1]}';
        $id = '6479240ead';
        $list = '[1,1,9,13,1]';
        $this->seedConfigs($json, $id, $list);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
