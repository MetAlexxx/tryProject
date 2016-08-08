<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function get_last_books()
	{
		$query = $this->db->query('SELECT b.bID, b.bName, b.year, b.cover, cat.catName, a.aFIO FROM T_books AS b 
							LEFT JOIN T_categories AS cat ON cat.catID = b.catID
							LEFT JOIN T_authors AS a ON a.aID = b.aID 
								ORDER BY  b.bID DESC LIMIT 3');
		return $query->result_array();
	}

    ////////////////////////////////////Authors/////////////////////////////////////////////////

    public function get_all_authors($num, $offset)
	{
		if(!$num){
            $this->db->order_by('aID','desc');
            $query = $this->db->get('T_authors', $num, $offset);
        } else {
            $this->db->order_by('aFIO','asc');
            $query = $this->db->get('T_authors');
        }
		return $query->result_array();
	}
    
    public function del_authors($aID)
	{
		$this->db->query("DELETE FROM T_authors WHERE aID='$aID'");
	}
    
    public function add_authors($aName)
	{
		if($aName == ''){
            $error = 'Введите имя автора!';
        }else{
        
            $query = $this->db->query("SELECT * FROM T_authors WHERE aFIO = '$aName'");
            $author =  $query->result_array();
            
            if($author){
                $error = 'Автор уже существует! ID = '.$author[0]['aID'];
            }else{
                $this->db->query("INSERT INTO T_authors(aFIO) VALUES ('$aName')");
                $error = 'Автор успешно добавлен!';
            }
        }
        
        return $error;
	}
    public function get_author_name($aID)
    {
        $query = $this->db->query("SELECT * FROM T_authors WHERE aID = '$aID'");
        $author =  $query->result_array();
        $name = $author[0]['aFIO'];
        
        return $name;
    }

	////////////////////////////////////Categories/////////////////////////////////////////////////

	public function get_category_name($cID)
    {
        $query = $this->db->query("SELECT * FROM T_categories WHERE catID = '$cID'");
        $cat =  $query->result_array();
        $name = $cat[0]['catName'];
        
        return $name;
    }
    public function get_all_categories($num, $offset)
	{
		if(!$num){
            $this->db->order_by('catName','asc');
            $query = $this->db->get('T_categories', $num, $offset);
        } else{
            $this->db->order_by('catID','desc');
            $query = $this->db->get('T_categories');
        }
		return $query->result_array();
	}
    
    public function del_categories($catID)
	{
		$this->db->query("DELETE FROM T_categories WHERE catID='$catID'");
	}
    
    public function add_categories($name)
	{
		if($name == ''){
            $error = 'Введите название категории!';
        }else{
        
            $query = $this->db->query("SELECT * FROM T_categories WHERE catName = '$name'");
            $cat =  $query->result_array();
            
            if($cat){
                $error = 'Категория уже существует! ID = '.$cat[0]['catID'];
            }else{
                $this->db->query("INSERT INTO T_categories(catName) VALUES ('$name')");
                $error = 'Категория успешно добавлена!';
            }
        }
        
        return $error;
	}
    
	////////////////////////////////////Books/////////////////////////////////////////////////

    public function count_books($str, $aID, $cID)
    {
        $this->db->select('*');
        $this->db->from('T_books');
        $this->db->join('T_authors', 'T_authors.aID = T_books.aID','left');
        $this->db->join('T_categories', 'T_categories.catID = T_books.catID','left');
        if($str){
            $this->db->like('bName', $str);
        }
        if($aID){
            $this->db->where('T_books.aID', $aID);
        }
        if($cID){
            $this->db->where('T_books.catID', $cID);
        }

        $this->db->order_by('bID','desc');
        $query = $this->db->get();
        $books =  $query->result_array();
        $count = 0;
        foreach ($books as $book) {
            $count++;
        }
        return $count;
    }

    public function get_book($bID)
	{
        $query = $this->db->query("SELECT * FROM T_books WHERE bID = '$bID'");
        $res = $query->result_array();

        return $res[0];
	}

    public function get_book_page($bID)
    {
        $query = $this->db->query("SELECT * FROM (SELECT b.bName, b.bID, b.year, b.source, b.cover, b.file, a.aFIO, c.catName FROM T_books AS b 
            LEFT JOIN T_authors AS a ON a.aID = b.aID 
            LEFT JOIN T_categories AS c ON c.catID = b.catID) AS Sel WHERE Sel.bID = '$bID'");
        
        $res = $query->result_array();
        
        return $res[0];
    }
    
    public function get_all_books($num, $offset)
	{
		
        $this->db->select('*');
        $this->db->from('T_books');
        $this->db->join('T_authors', 'T_authors.aID = T_books.aID','left');
        $this->db->join('T_categories', 'T_categories.catID = T_books.catID','left');
        
        $this->db->order_by('bID','desc');
        
        $query = $this->db->get(NULL, $num, $offset);
		return $query->result_array();
	}

    public function search_books($str, $aID, $cID, $num, $offset)
    {
        
        $this->db->select('*');
        $this->db->from('T_books');
        $this->db->join('T_authors', 'T_authors.aID = T_books.aID','left');
        $this->db->join('T_categories', 'T_categories.catID = T_books.catID','left');
        if($str){
            $this->db->like('bName', $str);
        }
        if($aID){
            $this->db->where('T_books.aID', $aID);
        }
        if($cID){
            $this->db->where('T_books.catID', $cID);
        }
        
        $this->db->order_by('bID','desc');        
        $query = $this->db->get(NULL, $num, $offset);
 
        return $query->result_array();
    }
    
    public function del_books($bID)
	{
		$query = $this->db->query("SELECT * FROM T_books WHERE bID='$bID'");
        $res = $query->result_array();
        $cover = './'.$res[0]['cover'];
        $file = './'.$res[0]['file'];

        if( $cover != './covers/default.jpg'){
           if(file_exists($cover)) unlink($cover);
        }
        if($file != './'){
            if(file_exists($file)) unlink($file);
        }

        $this->db->query("DELETE FROM T_books WHERE bID='$bID'");
	}
    
    public function add_books($bName, $catID, $aID, $year, $source)
	{
		if($bName == ''){
            $error = 'Введите название книги!';
        }else{
            $str = "INSERT INTO T_books(bName,"; 
            if($catID != '0') $str .= 'catID, ';
            if($aID != '0') $str .= 'aID,';
            $str .= "year, source) VALUES ('$bName', "; 
            if($catID != '0') $str .=$catID.', ';
            if($aID != '0') $str .= $aID.', ';
            $str .= "'$year', '$source')";
            
            $this->db->query($str);
            $error = 'Книга успешно добавлена!';
        }
        
        return $error;
	}
    
    public function edit_books($bID, $bName, $catID, $aID, $year, $source)
	{
		if($bName == ''){
            $error = 'Введите название книги!';
        }else{
            $str = "UPDATE T_books SET bName = '$bName', "; 
            if($catID != '0') $str .= "catID = '$catID', ";
                else $str .= "catID = null, "; 
            if($aID != '0') $str .= "aID = '$aID', ";
                else $str .= "aID = null, ";
            $str .= "year = '$year' , source = '$source' WHERE bID = '$bID'";
            
            $this->db->query($str);
            $error = 'Книга успешно изменена!';
        }
        
        return $error;
	}

    ////////////////////////////////////Files/////////////////////////////////////////////////

    public function upload_cover_books($bID, $cover)
    {
        $data = $this->db->query("SELECT cover FROM T_books WHERE bID = '$bID'");
        $data = $data->result_array();
        $path = './'.$data[0]['cover'];

        if( $path != './covers/default.jpg'){
           if (file_exists($path)) unlink($path);           
        }
        $this->db->query("UPDATE T_books SET cover = '$cover' WHERE bID = '$bID'");
        $error = 'Обложка изменена
        !';
       
        return $error;
    }

    public function upload_file_books($bID, $file)
    {
        $data = $this->db->query("SELECT file FROM T_books WHERE bID = '$bID'");
        $data = $data->result_array();
        $path = './'.$data[0]['file'];

        if( $path != './'){
           if (file_exists($path)) unlink($path);           
        }
        $this->db->query("UPDATE T_books SET file = '$file' WHERE bID = '$bID'");
        $error = 'Файл заменен!';
       
        return $error;
    }

}
