<?php
class UserDao
{
    private $_db; // Instance PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    /**
     * Set the value of _db
     *
     * @return  self
     */
    public function setDb(PDO $db)
    {
        $this->_db = $db;

        return $this;
    }

    //ajouter un utilisateur dans la base
    public function add(User $user)
    {
        $q = $this->_db->prepare('INSERT INTO
    user (mail, pseudo, password)
    VALUES (:mail, :pseudo, :password)');
        $q->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $q->bindValue(':pseudo', $user->getPseudo(), PDO::PARAM_STR);
        $q->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $q->execute();
    }

    //mettre à jour l'utilisateur
    public function update(User $user)
    {
        $q = $this->_db->prepare('UPDATE user
    SET mail = :mail,pseudo = :pseudo, password = :password
    WHERE id = :id');
        $q->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $q->bindValue(':pseudo', $user->getPseudo(), PDO::PARAM_STR);
        $q->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $q->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $q->execute();
    }

    //supprimer un utilisateur 
    public function delete(Int $id)
    {
        $this->_db->exec('DELETE FROM user WHERE id = ' . $id);
    }

    //récup tous les utilisateurs de la table user
    public function getAll()
    {
        $q = $this->_db->query('SELECT * FROM user');
        return $q->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    //récup un utilisateur en particulier
    public function get($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM user WHERE id = ' . $id);
        return $q->fetchObject(User::class);
    }
}
