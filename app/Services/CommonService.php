<?php 
namespace App\Services;

use App\Models\ThemeWhyChooseUs;
use App\Models\Theme;

class CommonService{
    public function getAllData($model_name, $where_cond){
        return $model_name::where($where_cond)->get();
    }

    public function getSingleRow($model_name, $where_cond){
        return $model_name::where($where_cond)->first();
    }

    public function getSingleColumn($model_name, $where_cond, $column_name, $rand_cond=""){
        $query = $model_name::where($where_cond);
        if(!empty($rand_cond))
            $query = $query->inRandomOrder();

        return $query->pluck($column_name)->first();
    }

    public function insertData($model_name, $data){
        return $model_name::create($data);
    }

    public function updateOrInsert($model_name, $where_cond, $data){
        return $model_name::updateOrInsert(
            $where_cond,
            $data
        );
    }

    public function deleteData($model_name, $where_cond){
        return $model_name::where($where_cond)->delete();
    }
}
?>