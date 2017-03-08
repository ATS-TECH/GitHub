<?php
$fields = mysql_num_fields ( $resultado );

for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $resultado , $i ) . "\t";
}
$header .="\n##";
while( $row = mysql_fetch_row( $resultado ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n##";
}
$data = str_replace( "\r" , "" , $data );

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";                        
}

header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=veiculo.csv");
header("Pragma: no-cache");
header("Expires: 0");
 
print $header.$data;

