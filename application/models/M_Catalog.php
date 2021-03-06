<?php
defined('BASEPATH' OR exit('No direct script access allowed'));
class M_Catalog extends CI_Model
{
      function __construct()
      {
          parent::__construct();
      }

      public function mCategory(){
            $SQL = "SELECT CategoryID,
                           CategoryName,
                           CategoryDesc
                    FROM Category
                    ORDER BY CategoryID ASC";
            $query = $this->db->query($SQL);
            if ($query->num_rows() > 0) {
              return $query->result();
            }else{
              return 'empty';
            }
      }

      public function mCategoryDesc($CatalogID){
            $SQL = "SELECT CategoryId,
                           CategoryName,
                           CategoryDesc
                    FROM   Category
                    WHERE  CategoryID = '$CatalogID'";
            $query = $this->db->query($SQL);
            if ($query->num_rows() > 0) {
              return $query->row();
            }else{
              return 'empty';
            }
      }

      public function mProduct($CatalogID){
            $SQL = "SELECT ProductID,
                           ProductName,
                           ProductDesc,
                           CategoryID,
                           ProductPicture
                     FROM  product
                     WHERE CategoryID = '$CatalogID'";
            $query = $this->db->query($SQL);
            if ($query->num_rows() > 0) {
              return $query->result();
            }else{
              return 'empty';
            }
          }

      public function mProductDetail($ProductID){
        $SQL = "SELECT PD.ProductID,
                       PD.ProductName,
                       PD.ProductDesc,
                       PD.CategoryID,
                       PD.ProductPicture,
                       CT.CategoryID,
                       CT.CategoryName,
                       CT.CategoryDesc
                FROM   product PD, category CT
                WHERE  PD.ProductID = '$ProductID' AND CT.CategoryID = PD.CategoryID";
        $query = $this->db->query($SQL);
        if ($query->num_rows() > 0){
          return $query->row();
        }else {
          return 'empty';
        }
      }

      public function mBrand(){
          $SQL = "SELECT BD.BrandID,
                  			 BD.BrandName,
                         BD.BrandDesc,
                         BD.BrandPicture,
                  			 PD.ProductName,
                         PD.ProductID
                  FROM  brand BD, product PD
                  WHERE BD.BrandName = PD.ProductName";
          $query = $this->db->query($SQL);
          if ($query->num_rows() > 0){
            return $query->result();
          }else {
            return 'empty';
          }
      }

      public function mSearch($search_item){
        $SQL = "SELECT ProductID,
                       ProductName,
                       ProductDesc,
                       ProductPicture,
                       CategoryID
                 FROM product
                 WHERE 1";
                 if ($search_item != '') {
                   $SQL.= " AND ProductName LIKE '%$search_item%' OR ProductDesc LIKE '%$search_item%'";
                 }
        $query = $this->db->query($SQL);
        if ($query->num_rows() > 0){
          return $query->result();
        }else{
          return 'error';
        }
      }

}
 ?>
