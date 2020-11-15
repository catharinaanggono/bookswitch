<?php 

    ### Classes & Objects for User
    class User {
    
        ### The properties of the class (User)
        private $userid; 
        private $name; 
        private $password; 
        private $email; 

        ### The constructor that creates an instance of a class (an object) - User 
        ### Accepts the parameters to intialize class properties
        public function __construct($userid, $name, $password, $email) {
            $this->userid = $userid; 
            $this->name = $name; 
            $this->password = $password; 
            $this->email = $email;
        }

        ### GetMethod: The retrieval of details of an User
        public function getUserid() {
            return $this->userid; 
        }

        public function getName() {
            return $this->name; 
        }

        public function getPassword() {
            return $this->password; 
        }

        public function getEmail() {
            return $this->email; 
        }

    }

?>