<?php
class Dashboard_integrasi extends CI_Model {

	public function __construct(){
		$this->load->database('forum');
		$this->load->library('session');
	}

	public function result_integrasi($start,$end){
		log_message('debug','>>> get_result_integrasi');
		$otherdb = $this->load->database('forum',TRUE); 
		//$query = "select * from all_objects where object_name like '%XEINVC_AR_INVOICE_HEADER%'";
		 $query ="SELECT * FROM
					(
					SELECT HEADER_CONTEXT,'INV' TYPE FROM XEINVC_AR_INVOICE_HEADER
					WHERE TRUNC(TRX_DATE) BETWEEN DECODE(TO_DATE('$start','YYYY/MM/DD'),NULL,TRUNC(SYSDATE),TO_DATE('$start','YYYY/MM/DD')) AND  DECODE(TO_DATE('$end','YYYY/MM/DD'),NULL,TRUNC(SYSDATE),TO_DATE('$end','YYYY/MM/DD'))
					UNION ALL
					SELECT SOURCE_INVOICE,'RCP' FROM XEINVC_AR_RECEIPTS_HEADER
					WHERE TRUNC(RECEIPT_DATE) BETWEEN DECODE(TO_DATE('$start','YYYY/MM/DD'),NULL,TRUNC(SYSDATE),TO_DATE('$start','YYYY/MM/DD')) AND  DECODE(TO_DATE('$end','YYYY/MM/DD'),NULL,TRUNC(SYSDATE),TO_DATE('$end','YYYY/MM/DD'))
					AND SOURCE_INVOICE IN (SELECT HEADER_CONTEXT FROM XEINVC_AR_INVOICE_HEADER)
					)PIVOT
					(
					COUNT(TYPE)
					for TYPE IN ('INV' INV,'RCP' RCP)
					) WHERE HEADER_CONTEXT !='UST'
					";
		 	$query 	= $otherdb->query($query, array());
 	 		return $query->result();
	}
	public function detail_result_integrasi($start,$end,$name){
		log_message('debug','>>> get_detail_result_integrasi');
		$otherdb = $this->load->database('forum',TRUE); 
		//$query = "select * from all_objects where object_name like '%XEINVC_AR_INVOICE_HEADER%'";
		 $query ="SELECT 
				NO, HEADER_CONTEXT, TYPE, DESCRIPTION
				,COUNT(*) JUMLAH
				FROM
				(
				 SELECT 
				   1 NO
				  ,header_context
				  ,'INV' TYPE
				  ,'Total Nota Belum Transfer AR Transaction (SIMKEU)' description
				   FROM xeinvc_ar_invoice_header
				  WHERE TRUNC(trx_date) BETWEEN DECODE(to_date('$start','YYYY/MM/DD'),NULL,TRUNC(SYSDATE),to_date('$start','YYYY/MM/DD')) AND DECODE(to_date('$end','YYYY/MM/DD'),NULL,TRUNC(SYSDATE),to_date('$end','YYYY/MM/DD'))
				    AND ar_status != 'S'
				UNION ALL
				 SELECT 
				   2
				  ,source_invoice
				  ,'RCP'
				  ,'Total Receipt Belum Transfer AR Receipt (SIMKEU)' description
				   FROM xeinvc_ar_receipts_header
				  WHERE TRUNC(receipt_date) BETWEEN DECODE(to_date('$start','YYYY/MM/DD'),NULL,TRUNC(SYSDATE),to_date('$start','YYYY/MM/DD')) AND DECODE(to_date('$end','YYYY/MM/DD'),NULL,TRUNC(SYSDATE),to_date('$end','YYYY/MM/DD'))
				    AND source_invoice IN
				    (SELECT header_context FROM xeinvc_ar_invoice_header
				    )
				    AND STATUS_RECEIPT != 'S'
				)
				WHERE decode('$name',NULL,'xx',HEADER_CONTEXT) = decode('$name',NUll,'xx','$name')
				group by NO, HEADER_CONTEXT, TYPE, DESCRIPTION
				order by 2,1
					";
		 	$query 	= $otherdb->query($query, array());
 	 		return $query->result();
	}
	public function detail_table_result_integrasi($start,$end,$context,$type){
		log_message('debug','>>> get_detail_table_result_integrasi');
		$otherdb = $this->load->database('forum',TRUE); 
		$query ="
				SELECT ROWNUM NO,trx_number, tgl_layanan, customer_name,inv_nota_layanan, inv_nota_jenis, nilai_nota, error_message FROM
				(
				 SELECT 'INV' trx_type
				  ,xai.header_context
				  ,xai.trx_number 
				  ,to_date(xai.trx_date) tgl_layanan
				  ,xai.customer_name
				  ,imn.inv_nota_layanan
				  ,imn.inv_nota_jenis
				  ,to_number(xai.amount) nilai_nota
				  ,xai.ar_message error_message
				   FROM xeinvc_ar_invoice_header xai
				  ,inv_mst_nota imn
				  WHERE trunc(xai.trx_date) BETWEEN decode(to_date('$start','YYYY/MM/DD'),NULL,trunc(SYSDATE),to_date('$start','YYYY/MM/DD')) AND decode(to_date('$end','YYYY/MM/DD'),NULL,trunc(SYSDATE),to_date('$end','YYYY/MM/DD'))
				    AND xai.ar_status                           != 'S'
				    AND xai.header_sub_context                   = imn.inv_nota_code (+)
				UNION ALL
				 SELECT 
				  'RCP' trx_type
				  ,xar.source_invoice
				  ,xar.receipt_number
				  ,to_date(xar.receipt_date)
				  ,xar.attribute3 customer_name
				  ,imn.inv_nota_layanan
				  ,imn.inv_nota_jenis
				  ,to_number(xar.amount)
				  ,xar.status_receiptmsg
				   FROM xeinvc_ar_receipts_header xar
				  ,inv_mst_nota imn
				  WHERE trunc(xar.receipt_date) BETWEEN decode(to_date('$start','YYYY/MM/DD'),NULL,trunc(SYSDATE),to_date('$start','YYYY/MM/DD')) AND decode(to_date('$end','YYYY/MM/DD'),NULL,trunc(SYSDATE),to_date('$end','YYYY/MM/DD'))
				    AND xar.source_invoice IN
				    (SELECT header_context FROM xeinvc_ar_invoice_header
				    )
				    AND xar.status_receipt != 'S'
				    AND xar.attribute14     = imn.inv_nota_code(+)
				) WHERE trx_type = '$type'
				  AND header_context = '$context'
				ORDER BY 3,2
					";
		 	$query 	= $otherdb->query($query, array());
 	 		return $query->result();

	}
	
}
