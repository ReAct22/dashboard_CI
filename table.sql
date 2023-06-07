CREATE TABLE tblmst_cabang(
kode varchar(255),
nama varchar(255),
users varchar(255),
create_at datetime,
update_at datetime,
users_update varchar(255),
status BOOLEAN DEFAULT 1
)

CREATE TABLE tblmst_top(
kode varchar(255),
hari varchar(255),
kota varchar(255),
keterangan varchar(255) DEFAULT '',
users varchar(255),
create_at datetime,
update_at datetime,
users_update varchar(255),
status BOOLEAN DEFAULT 1
)
drop table tblmst_supplier
CREATE TABLE tblmst_supplier(
kode varchar(255),
nama varchar(255),
alamat TEXT,
status_pkp BOOLEAN,
npwp varchar(255),
alamat_npwp TEXT,
kodecabang varchar(255),
no_telp varchar(255),
users varchar(255),
create_at datetime,
update_at datetime,
users_update varchar(255),
status BOOLEAN DEFAULT 1
)

CREATE TABLE tblmst_supervisor(
kode varchar(255),
nama varchar(255),
nohp varchar(255),
kodecabang varchar(255),
users varchar(255),
create_at datetime,
update_at datetime,
users_update varchar(255),
status BOOLEAN DEFAULT 1
)
