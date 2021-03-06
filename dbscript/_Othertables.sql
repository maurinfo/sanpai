create table accountledger
(
  id integer not null,
  firmid integer,
  datetransacted date,
  transactiontypeid integer DEFAULT NULL COMMENT '1:Sale 2:Receipt 3:Expense 4:Payment',
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
create table invoice
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
create table customer
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
  invoiceaddress varchar(300),
  invoicezip varchar(20),
  invoiceincharge varchar(100),
  invoicetoid integer default -9,
  paytoid integer default -9,
  primary key (id)
);

create table supplier
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
  showinvoicedue integer default 0,
  supplierclassid integer,
  taxinclusive integer,
  roundofftypeid integer,
  termid integer,
  paymethodid integer,
  paycutoffday integer,
  payday integer,
  remark varchar(2000),
  isaccountprinted integer default 1,
  updated timestamp,
  updateby integer,
  isactive integer default 1,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
  primary key (id)
);


create table sale
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
  updated date,
  updateby integer,
  isactive integer default 1,
  showdate integer,
  invoiceid integer,
  dateprinted date,
  postdate date,
  primary key (id)
);
create table saledetail
(
  id integer not null,
  saleid integer,
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
create table expense
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
  invoiceid integer,
  postdate date,
  primary key (id)
);
create table expensedetail
(
  id integer not null,
  expenseid integer,
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
  invoiceid integer,
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
