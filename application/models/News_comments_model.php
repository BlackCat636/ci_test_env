<?php
/**
 * Created by PhpStorm.
 * User: WhiteCat636
 * Date: 11.04.19
 * Time: 19:16
 */

class News_comments_model extends MY_Model
{
    const TABLE = 'news_comments';
    const PAGE_LIMIT = 5;

    protected $id;
    protected $news_id;
    protected $text;
    protected $time_created;
    protected $time_updated;

    protected $likes;

    function __construct($id = FALSE)
    {
        parent::__construct();
        $this->class_table = self::TABLE;
        $this->set_id($id);
    }

    /**
     * @return string
     */
    public function get_news_id()
    {
        return $this->news_id;
    }

    /**
     * @return string
     */
    public function get_full_text()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function get_time_created()
    {
        return $this->time_created;
    }

    /**
     * @param mixed $time_created
     */
    public function set_time_created($time_created)
    {
        $this->time_created = $time_created;
        return $this->_save('time_created', $time_created);
    }

    /**
     * @return int
     */
    public function get_time_updated()
    {
        return strtotime($this->time_updated);
    }

    /**
     * @param mixed $time_updated
     */
    public function set_time_updated($time_updated)
    {
        $this->time_updated = $time_updated;
        return $this->_save('time_updated', $time_updated);
    }

    /**
     * @return News_like_model
     */
    public function get_likes()
    {
        return $this->likes;
    }
    /**
     * @return News_like_model
     */
    public static function check_id($id)
    {

        $CI =& get_instance();

        $check = $CI->s->from(self::TABLE)->where('id',$id)->count();
        return $check;
    }

    /**
     * @param int $page
     * @param bool|string $preparation
     * @return array
     */
    public static function get_from_news($news_id,$preparation)
    {

        $CI =& get_instance();

        $_data = $CI->s->from(self::TABLE)->where('news_id',$news_id)->sortDesc('time_created')->many();

        $news_list = [];
        foreach ($_data as $_item) {
            $news_list[] = (new self())->load_data($_item);
        }

        if ($preparation === FALSE) {
            return $news_list;
        }

        return self::preparation($news_list, $preparation);
    }

    public static function preparation($data, $preparation)
    {

        switch ($preparation) {
            case 'short_info':
                return self::_preparation_short_info($data);
            default:
                throw new Exception('undefined preparation type');
        }
    }

    /**
     * @param News_comments_model[] $data
     * @return array
     */
    private static function _preparation_short_info($data)
    {
        $res = [];
        foreach ($data as $item) {
            $_info = new stdClass();
            $_info->id = (int)$item->get_id();
            $_info->news_id = (int)$item->get_news_id();
            $_info->text = $item->get_full_text();
            $_info->time = $item->get_time_updated();
            $res[] = $_info;
        }
        return $res;
    }


    public static function create($_insert_data){

        $CI =& get_instance();
        $res = $CI->s->from(self::TABLE)->insert($_insert_data)->execute();
        if(!$res){
            return FALSE;
        }
        return new self($CI->s->insert_id);
    }

    public static function delete($comment_id){
        $CI =& get_instance();

        $res = $CI->s->from(self::TABLE)->where('id ', $comment_id)->delete()->execute();
        if(!$res){
            return FALSE;
        }
        return $comment_id;
    }

}