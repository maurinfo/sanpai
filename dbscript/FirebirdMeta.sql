
create table accountbalanceadjustment
(
  id integer not null,
  firmid integer,
  firmclassid integer,
  dateadjusted date,
  amount numeric(15,4),
  primary key (id)
);
create table accountledger
(
  id integer not null,
  firmid integer,
  datetransacted date,
  transactiontypeid integer,
  referenceid integer,
  amount numeric(15,4),
  primary key (id)
);
create table accountledgerbeginning
(
  id integer not null,
  fiscalyearid integer,
  firmclassid integer,
  firmid integer,
  beginningbalance numeric(15,4),
  primary key (id)
);
create table addressbook
(
  id integer not null,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  incharge varchar(100),
  department varchar(200),
  address1 varchar(200),
  address2 varchar(200),
  zip varchar(20),
  telno varchar(50),
  faxno varchar(50),
  email varchar(50),
  remark varchar(2000),
  contractno varchar(20),
  contractdate date,
  municipalityid integer
);
create table bill
(
  id integer not null,
  referenceno varchar(15),
  supplierid integer,
  datestart date,
  dateend date,
  datedue date,
  showduedate integer,
  bankacctdetail varchar(1000),
  subtotal numeric(15,2),
  autotax integer,
  tax numeric(15,4),
  total numeric(15,4),
  note varchar(255),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  postdate date,
  primary key (id)
);
create table customerfirm
(
  id integer not null,
  headquarterid integer,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  customerfirmclassid integer,
  contactperson varchar(100),
  department varchar(200),
  address1 varchar(200),
  address2 varchar(200),
  zip varchar(20),
  telno varchar(50),
  faxno varchar(50),
  email varchar(50),
  collecttaxinclusive integer,
  collectroundofftypeid integer,
  collecttermid integer,
  collectmethodid integer,
  collectcutoffday integer,
  collectday integer,
  showinvoicedue integer default 0,
  supplierclassid integer,
  paytaxinclusive integer,
  payroundofftypeid integer,
  paytermid integer,
  paymethodid integer,
  paycutoffday integer,
  payday integer,
  remark varchar(2000),
  isaccountprinted integer default 1,
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  iscontractor integer,
  contractno varchar(20),
  contractdate date,
  forwarderid integer,
  recyclebranchid integer,
  iscontractorbranch integer,
  isforwarder integer,
  isrecyclecustomerfirm integer,
  isrecyclebranch integer,
  forwardpermitid integer,
  recyclepermitid integer,
  municipalityid integer,
  k_code integer,
  hai_code integer,
  iscustomerfirm integer,
  issupplier integer,
  billaddress varchar(300),
  billzip varchar(20),
  billincharge varchar(100),
  billtoid integer default -9,
  paytoid integer default -9,
  primary key (id)
);
create table dataposting
(
  id integer not null,
  dateposted date,
  primary key (id)
);
create table delivery
(
  id integer not null,
  referenceno varchar(15),
  customerid integer,
  datedelivered timestamp,
  subtotal numeric(15,2),
  autotax integer,
  tax numeric(15,4),
  total numeric(15,4),
  note varchar(255),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  showdate integer,
  invoiceid integer,
  dateprinted date,
  postdate date,
  primary key (id)
);
create table deliverydetail
(
  id integer not null,
  deliveryid integer,
  manifestid integer,
  itemid integer,
  itemunitid integer,
  qty numeric(15,4),
  price numeric(15,4),
  amount numeric(15,4),
  updated date,
  updateby integer,
  isactive integer default 1,
  datedelivered date,
  remark varchar(200),
  spec varchar(100),
  primary key (id)
);
create table deliveryreceipt
(
  id integer not null,
  referenceno varchar(15),
  supplierid integer,
  datedelivered timestamp,
  subtotal numeric(15,2),
  autotax integer,
  tax numeric(15,4),
  total numeric(15,4),
  note varchar(255),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  showdate integer,
  billid integer,
  postdate date,
  primary key (id)
);
create table deliveryreceiptdetail
(
  id integer not null,
  deliveryreceiptid integer,
  manifestid integer,
  itemid integer,
  itemunitid integer,
  qty numeric(15,4),
  price numeric(15,4),
  amount numeric(15,4),
  updated date,
  updateby integer,
  isactive integer default 1,
  datedelivered date,
  itemname varchar(300),
  itemunit varchar(10),
  primary key (id)
);
create table disposalmethod
(
  id integer not null,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  primary key (id)
);
create table firm
(
  id integer not null,
  headquarterid integer,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  firmclassid integer,
  contactperson varchar(100),
  department varchar(200),
  address1 varchar(200),
  address2 varchar(200),
  zip varchar(20),
  telno varchar(50),
  faxno varchar(50),
  email varchar(50),
  collecttaxinclusive integer,
  collectroundofftypeid integer,
  collecttermid integer,
  collectmethodid integer,
  collectcutoffday integer,
  collectday integer,
  showinvoicedue integer default 0,
  supplierclassid integer,
  paytaxinclusive integer,
  payroundofftypeid integer,
  paytermid integer,
  paymethodid integer,
  paycutoffday integer,
  payday integer,
  remark varchar(2000),
  isaccountprinted integer default 1,
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  iscontractor integer,
  contractno varchar(20),
  contractdate date,
  forwarderid integer,
  recyclebranchid integer,
  iscontractorbranch integer,
  isforwarder integer,
  isrecyclefirm integer,
  isrecyclebranch integer,
  forwardpermitid integer,
  recyclepermitid integer,
  municipalityid integer,
  k_code integer,
  hai_code integer,
  iscustomer integer default 0,
  issupplier integer default 0,
  billaddress varchar(300),
  billzip varchar(20),
  billincharge varchar(100),
  billtoid integer,
  paytoid integer,
  primary key (id)
);
create table fiscalyear
(
  id integer not null,
  datestart date,
  dateend date,
  name varchar(200),
  isactive integer default 1,
  primary key (id)
);
create table invoice
(
  id integer not null,
  referenceno varchar(15),
  customerid integer,
  datestart date,
  dateend date,
  datedue date,
  showduedate integer,
  bankacctdetail varchar(1000),
  subtotal numeric(15,2),
  autotax integer,
  tax numeric(15,4),
  total numeric(15,4),
  note varchar(255),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  dateprinted date,
  postdate date,
  primary key (id)
);
create table item
(
  id integer not null,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  itemclassid integer,
  itemcategoryid integer,
  itemunitid integer,
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  price numeric(15,4),
  primary key (id)
);
create table itemprice
(
  id integer not null,
  customerid integer,
  itemid integer,
  itemunitid integer,
  price numeric(15,4),
  primary key (id)
);
create table itemunit
(
  id integer not null,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  primary key (id)
);
create table manifest
(
  id integer not null,
  referenceno varchar(50),
  datemanifest date,
  incharge varchar(100),
  contractorid integer,
  contractorbranchid integer,
  permitclassid integer,
  wasteclassid integer,
  itemid integer,
  qty numeric(15,4),
  itemunitid integer,
  forwarder1id integer,
  forwardpermit1id integer,
  dateforward1 date,
  forwarder2id integer,
  forwardpermit2id integer,
  dateforward2 date,
  forwarder3id integer,
  forwardpermit3id integer,
  dateforward3 date,
  recyclebranchid integer,
  recyclepermitid integer,
  recycledate1 date,
  recycledate2 date,
  disposalmethodid integer,
  datereceived date,
  receivedbyid integer,
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  remark varchar(2000),
  deliveryid integer,
  otheritemname varchar(100),
  datemailed date,
  primary key (id)
);
create table municipality
(
  id integer not null,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  g_code integer,
  primary key (id)
);
create table payment
(
  id integer not null,
  referenceno varchar(15),
  supplierid integer,
  datepayment date,
  bankaccountid integer,
  amount0 numeric(15,4),
  amount1 numeric(15,4),
  amount2 numeric(15,4),
  amount3 numeric(15,4),
  amount4 numeric(15,4),
  amount5 numeric(15,4),
  amount6 numeric(15,4),
  total numeric(15,4),
  note varchar(255),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  billid integer,
  primary key (id)
);
create table permit
(
  id integer not null,
  permitno varchar(100),
  permitclassid integer,
  municipalityid integer,
  permittype integer,
  firmid integer,
  dateexpire date,
  isactive integer,
  primary key (id)
);
create table permitclass
(
  id integer not null,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  primary key (id)
);
create table receipt
(
  id integer not null,
  referenceno varchar(15),
  customerid integer,
  datereceipt date,
  bankaccountid integer,
  amount0 numeric(15,4),
  amount1 numeric(15,4),
  amount2 numeric(15,4),
  amount3 numeric(15,4),
  amount4 numeric(15,4),
  amount5 numeric(15,4),
  amount6 numeric(15,4),
  total numeric(15,4),
  note varchar(255),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  invoiceid integer,
  primary key (id)
);
create table staff
(
  id integer not null,
  name varchar(200),
  yomi varchar(20),
  jobtitle varchar(200),
  address varchar(400),
  telno varchar(50),
  email varchar(50),
  birthdate date,
  hiredate date,
  timein time,
  timeout time,
  updateby integer,
  isactive integer default 1,
  resignation date,
  stafftype varchar(50),
  primary key (id)
);
create table supplierfirm
(
  id integer not null,
  headquarterid integer,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  supplierfirmclassid integer,
  contactperson varchar(100),
  department varchar(200),
  address1 varchar(200),
  address2 varchar(200),
  zip varchar(20),
  telno varchar(50),
  faxno varchar(50),
  email varchar(50),
  collecttaxinclusive integer,
  collectroundofftypeid integer,
  collecttermid integer,
  collectmethodid integer,
  collectcutoffday integer,
  collectday integer,
  showinvoicedue integer default 0,
  supplierclassid integer,
  paytaxinclusive integer,
  payroundofftypeid integer,
  paytermid integer,
  paymethodid integer,
  paycutoffday integer,
  payday integer,
  remark varchar(2000),
  isaccountprinted integer default 1,
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  iscontractor integer,
  contractno varchar(20),
  contractdate date,
  forwarderid integer,
  recyclebranchid integer,
  iscontractorbranch integer,
  isforwarder integer,
  isrecyclesupplierfirm integer,
  isrecyclebranch integer,
  forwardpermitid integer,
  recyclepermitid integer,
  municipalityid integer,
  k_code integer,
  hai_code integer,
  issupplierfirm integer,
  issupplier integer,
  billaddress varchar(300),
  billzip varchar(20),
  billincharge varchar(100),
  billtoid integer default -9,
  paytoid integer default -9,
  primary key (id)
);
create table taxrate
(
  id integer not null,
  startdate date,
  enddate date,
  rate numeric(15,4),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  primary key (id)
);
create table tempfirm
(
  id integer not null,
  headquarterid integer,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  tempfirmclassid integer,
  contactperson varchar(100),
  department varchar(200),
  address1 varchar(200),
  address2 varchar(200),
  zip varchar(20),
  telno varchar(50),
  faxno varchar(50),
  email varchar(50),
  collecttaxinclusive integer,
  collectroundofftypeid integer,
  collecttermid integer,
  collectmethodid integer,
  collectcutoffday integer,
  collectday integer,
  showinvoicedue integer default 0,
  supplierclassid integer,
  paytaxinclusive integer,
  payroundofftypeid integer,
  paytermid integer,
  paymethodid integer,
  paycutoffday integer,
  payday integer,
  remark varchar(2000),
  isaccountprinted integer default 1,
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  iscontractor integer,
  contractno varchar(20),
  contractdate date,
  forwarderid integer,
  recyclebranchid integer,
  iscontractorbranch integer,
  isforwarder integer,
  isrecycletempfirm integer,
  isrecyclebranch integer,
  forwardpermitid integer,
  recyclepermitid integer,
  municipalityid integer,
  k_code integer,
  hai_code integer,
  iscustomer integer,
  issupplier integer,
  primary key (id)
);
create table useraccount
(
  id integer not null,
  staffid integer,
  username varchar(20),
  accesscode varchar(20),
  accounttype integer,
  primary key (id)
);
create table wasteclass
(
  id integer not null,
  code varchar(20),
  name varchar(300),
  yomi varchar(20),
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  primary key (id)
);