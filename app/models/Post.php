<?php

class Post {
    private $db;

    public function __construct(){
        $this->db=new Database;

    }

    public function findAllPosts(){
        //preparing query
        $this->db->query('SELECT * FROM posts ORDER BY created_at ASC');

        $results=$this->db->resultSet();

        return $results;

    }
    public function addPost($data){
        //prepare query
        $this->db->query('INSERT INTO posts(user_id,title,body) VALUES(:user_id,:title,:body)');

        //bind values
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function findPostById($id){
        //prepare statement
        $this->db->query('SELECT * FROM posts WHERE id=:id');

        //bind values
        $this->db->bind(':id',$id);

        $row=$this->db->single();

        return $row;
    }

    public function updatePost($data){
        //prepare statement
        $this->db->query('UPDATE posts SET title=:title, body=:body WHERE id=:id');
        //bind values
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);
        //execute statement
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}