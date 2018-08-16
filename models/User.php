<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\Connection;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    //内部成员变量
    private $id;
    private $username;
    private $authKey;
    private $accessToken;

    private $connection = null;

    /**
     * 构造函数
     */
    public function __construct($id = '100', $username = 'test', 
                                $authKey = null, $connection = null, $accessToken = null)
    {
        parent:: __construct();
        $this->id = trim($id);
        $this->username = trim($username);
        $this->authKey = trim($authKey);
        $this->connection = $connection;
        $this->accessToken = trim($accessToken);
    }

    /**
     * 根据给到的ID查询身份。
     *
     * @param string|integer $id 被查询的ID
     * @return IdentityInterface|null 通过ID匹配到的身份对象
     */
    public static function findIdentity($id)
    {
        return null;
    }

    /**
     * 根据 token 查询身份。
     *
     * @param string $token 被查询的 token
     * @return IdentityInterface|null 通过 token 得到的身份对象
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @return int|string 当前用户ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string 当前用户的（cookie）认证密钥
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @return string 当前用户名
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string 当前数据库链接
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return ($this->authKey === $authKey);
    }

    /**
     * @param string $username　被查询的用户名
     * @return string|null 通过username匹配到的用户名
     */
    public static function findByUsername($username)
    {
        return new User(md5($username), $username, \Yii::$app->security->generateRandomString());
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        try {
            $this->connection = new \yii\db\Connection([
                'dsn' => 'mysql:host=localhost;dbname=mysql',
                'username' => $this->username,
                'password' => $password,
                'charset' => 'utf8',
            ]);

            $this->connection->open();
        } catch (Exception $e) {
            $this->connection = null;
            return false;
        }

        return true;
    }

}
