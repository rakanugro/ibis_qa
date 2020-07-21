<?php

function selectConnection($port_code, $terminal_code, $conn){
    //SELECT CONNECTION
    if($port_code=="IDJKT"&&$terminal_code=="T3I")
    {
        $conn['ori'] = oriDb("IDJKT_T3I");
        $conn['billing'][0] = $conn['ori']['billing_idjkt_t3i'];
    }
    else if($port_code=="IDJKT"&&$terminal_code=="T3D")
    {
        $conn['ori'] = oriDb("IDJKT_T3D");
        $conn['billing'][0] = $conn['ori']['billing_idjkt_t3d'];			
    }
    else if($port_code=="IDJKT"&&$terminal_code=="T2D")
    {
        $conn['ori'] = oriDb("IDJKT_T2D");
        $conn['billing'][0] = $conn['ori']['billing_idjkt_t2d'];
    }
    else if($port_code=="IDJKT"&&$terminal_code=="T1D")
    {
        $conn['ori'] = oriDb("IDJKT_T1D");
        $conn['billing'][0] = $conn['ori']['billing_idjkt_t1d'];
    }
    else if($port_code=="IDPNK"&&$terminal_code=="T3I")
    {
        $conn['ori'] = oriDb("IDPNK_T3I");
        $conn['billing'][0] = $conn['ori']['billing_idpnk_t3i'];			
    }
}
?>