SELECT l.*,h.*,d.* FROM tbl_deanrecommendation d,tbl_leave l,tbl_hodrecommendation h WHERE d.status =0 and d.r_id = h.r_id;

SELECT l.*,h.*,d.* FROM tbl_deanrecommendation d,tbl_leave l,tbl_hodrecommendation h WHERE d.r_id in (select r_id from tbl_deanrecommendation);


SELECT * from tbl_deanrecommendation where status = 0;


SELECT d.*,h.comments from tbl_deanrecommendation d, tbl_hodrecommendation h where d.status = 0 and d.r_id = h.r_id;


SELECT d.*,l.* from tbl_deanrecommendation d, tbl_hodrecommendation h, tbl_leave l where d.status = 0 and d.r_id = h.r_id and h.req_id = l.req_id;


SELECT d.*,l.*,e.empname,h.comments as hremarks from tbl_deanrecommendation d, tbl_hodrecommendation h, tbl_leave l,tbl_employee e where d.status = 0 and d.r_id = h.r_id and h.req_id = l.req_id AND l.emp_id = e.emp_id;
