<?php

/**
 * @file      chatroomManager.php
 * @brief     File description
 * @author    Created by Oceane.TORCHE
 * @version   08.12.2021
 */


/**
 * @brief This function gets the chatrooms available in the DB
 * @return array|null
 */
function getChatrooms(){

    $query = "SELECT id,name,nb_users_max from chatrooms";
    $params = null;
    $queryResult = executeQuerySelect($query,$params);
    return $queryResult;

}

/**
 * @brief This function gets people connected to a chatroom in DB
 * @return array|null
 */
function getPeopleInChatroom(){

    $query = "SELECT Chatroom_id from users";
    $params = null;
    $nbPeopleInChatroom = executeQuerySelect($query,$params);

    return $nbPeopleInChatroom;
}


/**
 * @brief This function gets the message of a chatroom in DB
 * @param $id
 * @return array|null
 */
function getMessage($id){

    $query = "SELECT messages.content, messages.sending_timestamp, users.username FROM messages LEFT JOIN users ON users.id = messages.User_id WHERE messages.Chatroom_id =:id";
    $params = array (':id' =>$id);
    $queryResult = executeQuerySelect($query,$params);

    return $queryResult;
}


function updateMessageInDB($message,$info){

    $content = $message['writeMessageHere'];
    $user = $info['userid'];
    $chat = $info['chatid'];

    $query = "INSERT INTO messages (content,sending_timestamp,User_id,Chatroom_id) VALUES (:content,NOW(),:uid,:cid)";
    $params = array (':content' =>$content,':uid' => $user, ':cid' =>$chat);

    executeQueryInsert($query, $params);

}