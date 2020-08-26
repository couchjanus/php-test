<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Написати PHP класс 'SQL' який довзоляє фільтрувати масив синтаксисом схожим на синтаксис MySQL

## вхідний масив
$arr =  Array(
    Array(
        'first_name'=> 'Іра', 
        'last_name'=> 'Ворза',
        'age'=> 35
    ),
    Array(
        'first_name'=> 'Петро', 
        'last_name'=> 'Мазур',
        'age'=> 21
    ),
    Array(
        'first_name'=> 'Сергій', 
        'last_name'=> 'Юхимов',
        'age'=> 31
    ),			
    
    Array(
        'first_name'=> 'Ігор', 
        'last_name'=> 'Добрий',
        'age'=> 22
    ),
    Array(
        'first_name'=> 'Олег', 
        'last_name'=> 'Пархонов',
        'age'=> 20
    ),
    Array(
        'first_name'=> 'Станіслав', 
        'last_name'=> 'Гетьман',
        'age'=> 33
    ),				
);

##використання вашого класу SQL має виглядати так (можете вибрати рівень який зможете реалізувати)

#------{Варіант 1} -----------(1 рівень важкості)

class SQL 
{
    protected $conn;
	private $host = "localhost";
	private $username = "root";
	private $password = "ghbdtn";
	private $dbname = "test";
    
    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        $this->conn->set_charset("utf8");
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function arr_to_table($arr, $table_name='users')
    {
        $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, age) VALUES (?,?,?);");
        $stmt->bind_param('ssi', $first_name, $last_name, $age);

        // Insert record
        foreach($arr as $user){
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $age = $user['age'];
            $stmt->execute();
        }
        $stmt->close();
    }

    public function run($sql)
    {
        $data = [];
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();
        return $data;
    }

}

$table = new SQL();
// $table->arr_to_table($arr);

// $result_arr = $table->run('SELECT first_name, last_name, age FROM users');
// $result_arr = $table->run('SELECT first_name, last_name, age FROM users WHERE age<=22');
// $result_arr = $table->run('SELECT first_name, last_name, age FROM users WHERE age<=22  ORDER BY age DESC');

$result_arr = $table->run('SELECT first_name as "Имя", last_name as "Фамилия", age FROM users WHERE age <= 22 ORDER BY age DESC');
print_r($result_arr);
