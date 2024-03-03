<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\classTb;
use App\Models\userRole;
use App\Models\subjectTB;
use App\Models\permissionPage;
use App\Models\permissionPageforuser;
use App\Models\perHouserSalaryForTecher;
use App\Models\transpoer_detail;
use App\Models\transpoer_price_details;
use App\Models\allowanceTb;
use App\Models\additional_allowance;

class deleteData extends Controller
{
    /**
     * Delete a resource from the specified model.
     *
     * @param  string  $modelClass The model class name.
     * @param  mixed  $id The primary key of the model to delete.
     * @return void
     */
    public function deleteResource($modelClass, $id){
        $modelNamespace = "App\\Models\\" . $modelClass;
        if(class_exists($modelNamespace)){
            $model = $modelNamespace::findOrFail($id);
            $del = $model->delete();
            $alertCall = new forAlert();
            $alertCall->alertTp($del);
        } else {
            // Handle the case where the model class does not exist
            // This could be logging the error or returning a response indicating the error
        }
    }

    //>> Class delete
    public function classDelete($id){
      $this->deleteResource('classTb', $id);
   }

   // >> subject delete
   public function subjectDelete($id){
      $this->deleteResource('subjectTB', $id);
   }

   // >> staff delete
   public function staffDelete($id){
      $this->deleteResource('User', $id);
   }

   // >> teacher delete
   public function teacherDelete($id){
      $this->deleteResource('User', $id);
   }

   // >> admin delete
   public function adminDelete($id){
      $this->deleteResource('User', $id);
   }

   // >> userRole delete
   public function userRoleDelete($id){
      $this->deleteResource('userRole', $id);
   }

   // >> PermissionPG delete
   public function permissionPgDelete($id){
      $this->deleteResource('permissionPage', $id);
   }

    // >> Permission for user delete
   public function permission_foruserDelete($id){
      $this->deleteResource('permissionPageforuser', $id);
   }

    // >>Per Hour Salary Band for user delete
   public function PerHour_SalaryBandDelete($id){
      $this->deleteResource('perHouserSalaryForTecher', $id);
   }

    // >> delete Tranport_detials
   public function delete_Transport_detials($id){
      $this->deleteResource('transpoer_detail', $id);
   }
    // >> delete Tranport_detials_price
   public function delete_transport_detials_price($id){
      $this->deleteResource('transpoer_price_details', $id);
   }
    // >> delete allowance
   public function delete_allowance($id){
      $this->deleteResource('allowanceTb', $id);
   }

    // >> delete additional_allowance
   public function delete_additional_allowance($id){
      $this->deleteResource('additional_allowance', $id);
   }

}

/*
Alert
*/
class forAlert{
    public function alertTp($del){
        if($del){
            return "success";
        } else {
            return "fail";
        }
    }
}
