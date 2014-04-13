<h2>{table}</h2>

<?php
echo anchor(site_url("{controller_name_l}/add/"),'Add a {table}','class="btn btn-primary"');
if(!$results){
	echo '<h1>{table} No Data</h1>';
	exit;
}

$header = array_keys($results[0]);

for($i=0;$i<count($results);$i++)
{
    $id = array_values($results[$i]);
    $results[$i]['View']     = anchor(site_url('{controller_name_l}/view/'.$id[0]),'View');
    $results[$i]['Edit']     = anchor(site_url('{controller_name_l}/edit/'.$id[0]),'Edit');
    $results[$i]['Delete']   = anchor(site_url('{controller_name_l}/delete/'.$id[0]),'Delete',array('onClick'=>'return deletechecked(\' '.site_url('{controller_name_l}/delete/'.$id[0]).' \')'));
                                // anchor(site_url('{controller_name_l}/delete/'.$id[0]),'Delete',array('onClick'=>'return deletechecked(\' '.base_url().'index.php/{controller_name_l}/delete/'.$id[0].' \')'));
	array_shift($results[$i]);                        
}
        
$clean_header = clean_header($header);
array_shift($clean_header);
$tmpl = array ( 'table_open'  => '<table class="table table-hover">' );

$this->table->set_template($tmpl); 
$this->table->set_heading($clean_header); 

// view
echo $this->table->generate($results); 
echo $this->pagination->create_links();
?>
<script type="text/javascript">
    function deletechecked(link)
    {
        var answer = confirm('Delete item?')
        if (answer)
        {
            window.location = link;
        }
        
        return false;  
    }

</script>