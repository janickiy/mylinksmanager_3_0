<?php

/********************************************
 * My Links Manager 3.0.0 alfa
 * Copyright (c) 2011-2018 Alexander Yanitsky
 * Website: http://janicky.com
 * E-mail: janickiy@mail.ru
 * Skype: janickiy
 ********************************************/

defined('MYLINKSMANAGER') || exit('My Links Manager: access denied!');

set_time_limit(0);

// config
require_once "config/config_db.php";

// check install
require_once "lib/check_install.inc";
require_once "sys/engine/classes/Helper.php";
require_once "vendor/PHPMailer/class.phpmailer.php";

$dbh = new mysqli($ConfigDB["host"], $ConfigDB["user"], $ConfigDB["passwd"], $ConfigDB["name"]);

if (mysqli_connect_errno()) {
    exit("Error connecting to MySQL database: Database server " . $ConfigDB["host"] . " is not available!");
}

if ($ConfigDB["charset"] != '') {
    $dbh->query("SET NAMES " . $ConfigDB["charset"] . "");
}


// Get a settings of catalogue
$query = "SELECT * FROM " . $ConfigDB["prefix"] . "settings";
$result = $dbh->query($query);

if (!$result) exit('Error executing SQL query!');

$settings = $result->fetch_array();
$result->close();

// interface module
include "templates/language/" . $settings['language'] . ".inc";

// Check all hidden and new links
$query = "SELECT * FROM " . $ConfigDB["prefix"] . "links WHERE status='hide'";
$result = $dbh->query($query);

if (!$result) {
    throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
}

while ($links = $result->fetch_array()) {
    $date_check = strtotime($links['time_check']);
    $interval_check = ceil((time() - $date_check) / 3600 / 24);

    if ($links['check_link'] == "yes" && $interval_check > $settings['check_interval'] && $interval_check != 1) {
        if (check_url_link($links['reciprocal_link'], $settings['url'])) {
            if ($settings['add_to_blacklist'] == "yes") {
                $query = "UPDATE " . $ConfigDB["prefix"] . "links SET status='black', time_check=NOW(), reason='" . REASON_ABSENSE_RECIPROCAL . "' WHERE id=" . $links['id'];
            } else {
                $query = "DELETE FROM " . $ConfigDB["prefix"] . "links WHERE id=" . $links['id'];
            }

            if ($dbh->query($query)) {
                // Notify the user about his link was removed
                Helper::sendmail_del_link($links, STR_SUBJECT_DEL);
            }
        } else {
            // Check on, whether the page of answer link for index by metatag <meta name=robot>
            if (Helper::checkMeta($links['reciprocal_link'])) {
                if ($settings['add_to_blacklist'] == "yes") {
                    $query = "UPDATE " . $ConfigDB["prefix"] . "links SET status='black', time_check=NOW(), reason='" . REASON_CLOSED_FOR_INDEX_META . "' WHERE id=" . $links['id'];
                } else {
                    $query = "DELETE FROM " . $ConfigDB["prefix"] . "links WHERE id=" . $links['id'];
                }

                if ($dbh->query($query)) {
                    // Notify the user about his link was removed
                    Helper::sendmail_del_link($links, STR_SUBJECT_DEL);
                }
            } else {
                // Check on, whether the directory with answer link is closed for index
                if (Helper::checkRobots($links['reciprocal_link'])) {
                    if ($settings['add_to_blacklist'] == "yes") {
                        $query = "UPDATE " . $ConfigDB["prefix"] . "links SET status='black', time_check=NOW(), reason='" . REASON_CLOSED_FOR_INDEX_ROBOT . "' WHERE id=" . $links['id'];
                    } else {
                        $query = "DELETE FROM " . $ConfigDB["prefix"] . "links WHERE id=" . $links['id'];
                    }

                    if ($dbh->query($query)) {
                        // Notify the user about his link was removed
                        Helper::sendmail_del_link($links, STR_SUBJECT_DEL);
                    }
                } else {
                    $update = "UPDATE " . $ConfigDB["prefix"] . "links SET status='show', time_check=NOW(), reason='', number_check=0 WHERE id=" . $links['id'];

                    if ($dbh->query($update)) {
                        // Notify the user about his link was restored
                        Helper::sendMailAdd($links, STR_SUBJECT_ADD);
                    }
                }
            }
        }
    }

    $result->close();
}

// Check all new link
$query = "SELECT * FROM " . $ConfigDB["prefix"] . "links WHERE status='new'";
$result = $dbh->query($query);

if (!$result) {
    throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
}

while ($links = $result->fetch_array()) {
    $date_check = strtotime($links['time_check']);
    $interval_check = ceil((time() - $date_check) / 3600 / 24);
    $reciprocal_link = $links['reciprocal_link'];

    if ($links['check_link'] == "yes" && $interval_check > $settings['check_interval'] && $interval_check != 1) {
        if (Helper::checkUrlLink($reciprocal_link)) {
            $query = "UPDATE " . $ConfigDB["prefix"] . "links SET status='show',
												time_check=NOW()
							WHERE id=" . $links['id'];

            if ($dbh->query($query)) {
                // Notify the user about his link was added to catalogue
                Helper::sendMailAdd($links, STR_SUBJECT_ADD);
            }
        } else {
            if ($settings['add_to_blacklist'] == "yes") {
                $query = "UPDATE " . $ConfigDB["prefix"] . "links SET status='black',
													time_check=NOW(),
													reason='" . REASON_ABSENSE_RECIPROCAL . "'
								  WHERE id=" . $links['id'];

                $dbh->query($query);
            } else {
                $query = "DELETE FROM " . $ConfigDB["prefix"] . "links WHERE id=" . $links['id'];
                $dbh->query($query);
            }
        }
    }
}

$result->close();

// Check all other links
$query = "SELECT * FROM " . $ConfigDB["prefix"] . "links WHERE status='show'";
$result = $dbh->query($query);

if (!$result) {
    throw new ExceptionMySQL($dbh->error, $query, "Error executing SQL query!");
}

while ($links = $result->fetch_array()) {
    $date_check = strtotime($links['time_check']);
    $interval_check = ceil((time() - $date_check) / 3600 / 24);

    if ($links['check_link'] == "yes" && $interval_check > $settings['check_interval'] && $interval_check != 1) {
        if (Helper::checkUrlLink($links['reciprocal_link'], $settings['url'])) {
            if ($links['number_check'] == $settings['number_check']) {
                // Form SQL-query to hide link
                $update = "UPDATE " . $ConfigDB["prefix"] . "links SET status='hide', time_check=NOW(), reason='" . REASON_ABSENSE_RECIPROCAL . "' WHERE id=" . $links['id'];

                if ($dbh->query($update)) {
                    // Notify the user about his link was hidded
                    $nscript = strpos($_SERVER['REQUEST_URI'], "admin");
                    $root = substr($_SERVER['REQUEST_URI'], 0, $nscript);
                    $url_link_edit = "" . $_SERVER['SERVER_NAME'] . $root . "edit.php?id=" . $links['id'] . "&token=" . $links['token'] . "";

                    Helper::sendmail_hide_link($links, $url_link_edit, STR_SUBJECT_HIDE);
                }
            } else {
                $update = "UPDATE " . $ConfigDB["prefix"] . "links SET time_check=NOW(), number_check=number_check + 1 WHERE id=" . $links['id'];
                $dbh->query($update);
            }
        } else {
            // Check the page of answer link on index
            if (Helper::checkMeta($links['reciprocal_link'])) {
                if ($links['number_check'] == $settings['number_check']) {
                    // Form SQL-query to hide link
                    $update = "UPDATE " . $ConfigDB["prefix"] . "links SET status='hide', time_check=NOW(), reason='" . REASON_CLOSED_FOR_INDEX_ROBOT . "' WHERE id=" . $links['id'];

                    if ($dbh->query($update)) {
                        // Notify the user about the link was hidded
                        Helper::sendmail_hide_link2($links, MSG_CLOSED_FOR_INDEX_ROBOT, STR_SUBJECT_HIDE);
                    }
                } else {
                    $update = "UPDATE " . $ConfigDB["prefix"] . "links SET time_check=NOW(), number_check=number_check + 1 WHERE id= " . $links['id'];
                    $dbh->query($update);
                }
            } else {
                // Check the directory is closed for index
                if (Helper::checkRobots($links['reciprocal_link'])) {
                    if ($links['number_check'] == $settings['number_check']) {
                        // Form SQL-query to hide link
                        $update = "UPDATE " . $ConfigDB["prefix"] . "links SET status='hide', time_check=NOW(), reason='" . REASON_CLOSED_FOR_INDEX_ROBOT . "' WHERE id= " . $links['id'];

                        if ($dbh->query($update)) {
                            // Notify the user about his link was hidded
                            $reason = MSG_CLOSED_FOR_INDEX_ROBOT;

                            Helper::sendmail_hide_link2($links, $reason, STR_SUBJECT_HIDE);
                        }
                    } else {
                        $update = "UPDATE " . $ConfigDB["prefix"] . "links SET time_check = NOW(), number_check=number_check + 1 WHERE id=" . $links['id'];
                        $dbh->query($update);
                    }
                } else {
                    $update = "UPDATE " . $ConfigDB["prefix"] . "links SET time_check=NOW(), reason='', number_check=0 WHERE id= " . $links['id'];
                    $dbh->query($update);
                }
            }
        }
    }
}

$result->close();

$dbh->close();
