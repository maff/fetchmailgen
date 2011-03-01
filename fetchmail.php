<?php
require_once 'config.inc.php';

if(isset($conf['query'][$conf['querytype']])) {
    try {
        $stmt = $db->query($conf['query'][$conf['querytype']]);
        $rows = $stmt->fetchAll(PDO::FETCH_CLASS, 'ArrayObject');
    } catch(PDOException $e) {
        echo $e->getMessage() . "\n";
        exit (1);
    }
} else {
    echo 'Query type ' . $conf['querytype'] . ' is not defined.' . "\n";
    exit(1);
}

if(count($rows) > 0)
{
    $fetchmailrc = $conf['default_options'];
    foreach($rows as $row)
    {
        if(	!empty($row->remoteserver)
            && !empty($row->remoteuser)
            && !empty($row->remotepass)
            && !empty($row->destination))
        {
            if(!empty($row->options))
                $row->options = 'options ' . $row->options;

        $fetchmailrc .= <<<EOF

# -------------------------

poll $row->remoteserver
    proto pop3
    user "$row->remoteuser"
    pass "$row->remotepass"
    is $row->destination
    $row->options
EOF;
        }
    }
}

if(!isset($fetchmailrc)) {
    $fetchmailrc = '';
}

$fp = fopen($conf['fetchmailrc'], 'w');
fwrite($fp, $fetchmailrc);
fclose($fp);

chmod($conf['fetchmailrc'], 0600);