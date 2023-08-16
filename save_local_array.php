<?php
$sql = 'select
        s.supplierCode, s.supplierZip, s.supplierPhonenumber,
        spl.productLineNo, spl.productLine,
        p.productName, p.MSRP
        from suppliers s
        inner join supplierproductlines spl on s.supplierName = spl.supplierName
        inner join products p on s.supplierZip = p.supplierZip';
$dg = new C_DataGrid($sql, "supplierCode", "suppliers");
$dg->enable_edit('INLINE');
$dg->set_col_readonly("productLineNo, productLine, productName, MSRP");
$dg->display();
?>