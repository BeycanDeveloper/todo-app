<?php 

/**
 * @package BeycanPress/TodoApp
 * @version 1.0.0
 * @author BeycanDeveloper
 * @see https://halilbeycan.com/todo-app
 */
class TodoApp
{
    /**
     * Todo listemizin bulunacağı json dosyası kolayca ulaşabilmek için bunda tutalım
     * @var string
     */
    private string $todoListPath;

    /**
     * Belki ihtiyacımız olur diye bunu da alalım ve tutalım nereden bilelim belki ileri de günlük todo tutarız :D
     * @var string
     */
    private string $dataFolder;

    /**
     * Sınıf başlatıldığında var olan todo listi de alalım
     * @var array
     */
    private array $todoList = [[]];

    /**
     * Şimdi ki zaman
     * @var string
     */
    private string $date;

    /**
     * Todo uygulamamız ile tüm işlemleri bu sınıf aracılığı ile yapacağız
     * doğal olarak bu sınıf başlatıldığın da ihtiyacı olan şeyleri test etsin
     * ve olmayanları oluştursun.
     * @param string $path sınıfın başlatıldığı dizini alıyoruz.
     * @return void
     */
    public function __construct( string $path )
    {
        // Zamanı ayarla
        $this->date = date( 'Y-m-d H:i:s' );

        // Data klasörümüzü ve data dosyamızı tanımlayalım
        $this->dataFolder = $path . 'data';
        $this->todoListPath = $this->dataFolder . DIRECTORY_SEPARATOR . 'todo-list.json';
        
        // Klasörümüzün kontrolünü yapalım yoksa oluşturalım
        if ( ! is_dir( $this->dataFolder ) ) 
        {
            mkdir( $this->dataFolder );
        }

        // Dosyamız yoksa oluşturalım
        if ( ! file_exists( $this->todoListPath ) )
        {
            file_put_contents( $this->todoListPath, json_encode( [[]] ) );
        }
        else 
        {
            $this->todoList = $this->getTodoList();
        }

    }

    /**
     * @param string $newTodo Gönderilen görevimiz
     * 
     * Güncelleme sırasında bir hata var mı?
     * @return bool
     */
    public function add( string $newTodo ) : bool
    {   
        // Güncelleme ve silme işlemlerini bu token ile yapacağız
        $token = md5( $newTodo.$this->date );
        $newTodo = $this->escape( $newTodo );

        $todoList = array(
            $token => array(
                'id' => $token,
                'text' => $newTodo,
                'created' => $this->date,
                'updated' => $this->date,
                'status' => false
            )
        );

        $newTodoList = array_merge( $todoList, $this->todoList );

        if ( isset( $newTodoList[0] ) ) {
            unset( $newTodoList[0] );
        }

        return $this->saveTodoList( $newTodoList ); 
    }

    /**
     * @param string $token todo ögemizin id'si
     * 
     * @return bool silindi mi silinmedi mi?
     */
    public function delete( string $token ) : bool
    {
        if ( $this->audit( $token ) ) 
        {
            unset( $this->todoList[$token] );
            return $this->saveTodoList( $this->todoList ); 
        } 
        else 
        {
            return false;
        }
    }

    /**
     * @param string $token todo ögemizin id'si
     * @param string yeni gönderilen todo
     * 
     * @return bool güncelleme işlemi başarılı mı? Başarısz mı?
     */
    public function update( string $token, string $newTodo ) : bool
    {
        if ( $this->audit( $token ) ) 
        {
            $newTodo = $this->escape( $newTodo );
            $this->todoList[$token]['text'] = $newTodo;
            $this->todoList[$token]['updated'] = $this->date;
            return $this->saveTodoList( $this->todoList ); 
        } 
        else 
        {
            return false;
        }
    }

    /**
     * Todomuz tamamlandı
     * 
     * @param string $token todo ögemizin id'si
     * 
     * @return bool güncelleme işlemi başarılı mı? Başarısz mı?
     */
    public function complete( string $token ) : bool
    {
        if ( $this->audit( $token ) ) 
        {
            $this->todoList[$token]['status'] = true;
            $this->todoList[$token]['completed'] = $this->date;
            return $this->saveTodoList( $this->todoList ); 
        } 
        else 
        {
            return false;
        }
    }

    /**
     * Şuan için sadece varlığını test etsekte belki ileride bir çok şey test edilebilir.
     * Ayrıca dışarıda kontrol etmek istersek kolaylık sağlar
     * @param string $token todo id
     * 
     * @return bool 
     */
    public function audit( string $token ) : bool
    {
        if ( isset( $this->todoList[$token] ) ) 
        {   
            return true;
        } 
        else 
        {
            return false;
        }
    }

    /**
     * Todo listesini alalım
     * @return array todo list
     */
    public function getTodoList() : array
    {
        return json_decode( file_get_contents( $this->todoListPath ), true );
    }

    /**
     * Todo listesinin sırasını değiştirelim
     * @param array $todoList Sırası değiştirilmiş yeni Todo listimiz
     * @return bool todo list
     */
    public function updateListOrder( array $todoList ) : bool
    {
        $newTodoList = array();
        foreach ( $todoList as $key => $value ) {
            $newTodoList[$value['id']] = $value;
        }
        return $this->saveTodoList( $newTodoList ); 
    }

    /**
     * Todo listesini kaydetmek için
     * @param array $newTodoList güncellenmiş yeni todo listesi
     * 
     * Güncelleme sırasında bir hata var mı?
     * @return bool
     */
    public function saveTodoList( array $newTodoList ) : bool
    {
        return file_put_contents( $this->todoListPath, json_encode( $newTodoList ) );
    }

    /**
     * Girilen metni temizlemek için
     * Şuan .json kullandığımız için bu yeterli olacaktır.
     * @param string $newTodo
     * 
     * @return string
     */
    public function escape( string $newTodo ) : string
    {
        return strip_tags( $newTodo );
    }

}