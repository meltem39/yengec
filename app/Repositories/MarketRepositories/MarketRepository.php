<?php

namespace App\Repositories\MarketRepositories;

use App\Models\Market;
use App\Repositories\EloquentBaseRepository;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class MarketRepository.
 */
class MarketRepository extends EloquentBaseRepository implements MarketRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Market $model)
    {
        date_default_timezone_set('Etc/GMT-3');

        $this->model = $model;
        parent::__construct($this->model);
    }


    public function validationControl($data){
        $validator = Validator::make($data, [
            'marketplaces' => 'required',
        ]);

        return $validator;
    }


    public function integrationList(){
        $list = $this->model->where("user_id", $this->authUser()->id)->where("deleted_at", NULL)->get();
        return $list;
    }

    public function integrationCreate($data){

        $validation_control = $this->validationControl($data);
        if($validation_control->fails()){
            return ["status" => false,  "message" => $validation_control->errors()];
        }

        if(isset($data["password"]))
            $data["password"] = bcrypt($data["password"]);


        $data["user_id"] = $this->authUser()->id;
        $market = Market::create($data);

        return ["status" => true, "data" => $market];
    }

    public function integrationUpdate($data){

        $item = $this->model->findOrFail($data["id"]);

        $validation_control = $this->validationControl($data);
        if($validation_control->fails()){
            return ["status" => false,  "message" => $validation_control->errors()];
        }

        if(isset($data["password"]))
            $data["password"] = bcrypt($data["password"]);

        $item->update($data);


        return ["status" => true, "data" => $item];
    }

    public function integrationDelete($id){
        $this->model->findOrFail($id)->delete();
        return ["status" => true];


    }
}
