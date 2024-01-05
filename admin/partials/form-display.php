<h1>ADMIN AREA PAGE</h1>
<br>
<h2> User Form Informations : </h2>
<?php
global $wpdb;
$table_name = $wpdb->prefix . "senpai_form_test";
$result = $wpdb->get_results("SELECT * FROM $table_name ");
if ($result != []) {
?>
    <table>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>PHONE</th>
        <th>MESSAGE</th>
        <th colspan="2">ACTION</th>
        <?php
        foreach ($result as $row) {
        ?>
            <tr>
                <td>
                    <input readonly="readonly" value=" <?php echo ($row->id); ?>">
                </td>
                <td> <input id="_name" readonly="readonly" value=" <?php echo ($row->name); ?> "></td>
                <td> <input id="_email" readonly="readonly" value="<?php echo ($row->email); ?>"> </td>
                <td> <input id="_phone" readonly="readonly" value="<?php echo ($row->phone); ?>"> </td>
                <td> <input id="_message" readonly="readonly" value=" <?php echo ($row->message); ?>"> </td>
                <td>
                    <button type="button" style="width: 100px; color:blue;" class="edit" data-id="<?php echo ($row->id); ?>" data-name="<?php echo ($row->name); ?>" data-email="<?php echo ($row->email); ?>" data-phone="<?php echo ($row->phone); ?>" data-message="<?php echo ($row->message); ?>"> EDIT</button>
                </td>
                <td>
                    <button type="button" style="width: 100px; color:red;" class="delete" row-id="<?php echo ($row->id); ?>"> DELETE </button>
                </td>
            </tr>

        <?php
        }
        ?>
        <table>

            <!-- The form -->

            <div id="editForm" hidden>
                <form id="myForm" action="process.php" method="post">
                        <input type="input" id="hidden_id" value=" " hidden>
                    Name: <input type="input" id="name" value=" "><br><br>
                    E-mail: <input type="text" id="email" value=" "><br><br>
                    Phone: <input type="tel" id="phone" value=" "><br><br>
                    Message: <textarea style="vertical-align: middle;" id="message" rows="5" cols="40" value=" "></textarea><br><br>
                    <button type="submit" style=" vertical-align: middle; width: 100px; color:aliceblue;
    border:#FF0000; background:#28a745 ; margin:auto;" id="saveButton" value="Submit"> Save </button>
                </form>
            </div>

        <?php
    } else {
        echo ("The database is currently empty! check out later !");
    }
        ?>