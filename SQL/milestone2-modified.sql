-- -----------------------------------------------------
-- Table Employees
-- -----------------------------------------------------
CREATE  TABLE Employees (
  EmpID INT NOT NULL ,
  Username VARCHAR2(45) NOT NULL,
  Firstname VARCHAR2(45) NOT NULL ,
  Lastname VARCHAR2(45) NOT NULL ,
  SSN INTEGER(11) NOT NULL ,
  Password VARCHAR2(45) NOT NULL,
  Department varchar2(20) NOT NULL,
  Employment_Date DATE NOT NULL ,
  Constraint Employees_PK PRIMARY KEY (EmpID));
  
--auto_increment
create sequence Employees_id_seq start with 1 increment by 1;
create or replace trigger Employees_insert
before insert on Employees
for each row
begin
    select Employees_id_seq.nextval into :new.EmpID from dual;
end;
/

-- -----------------------------------------------------
-- Table Engineers
-- -----------------------------------------------------
CREATE  TABLE Engineers (
  EngID INT NOT NULL ,
  Department VARCHAR2(45) NULL ,
  EmpID INT NOT NULL,
  Address VARCHAR2(45),
  Birthday DATE,
  Sex VARCHAR2(10),
  Age int,
  Email VARCHAR2(40),
  Description VARCHAR2(100),
  CONSTRAINT Engineers_pk PRIMARY KEY (EngID),
  CONSTRAINT fk_Engineers_Employees1
    FOREIGN KEY (EmpID )
    REFERENCES Employees (EmpID));
  
--auto_increment
create sequence Engineers_id_seq start with 1 increment by 1;
create or replace trigger Engineers_insert
before insert on Engineers
for each row
begin
    select Engineers_id_seq.nextval into :new.EngID from dual;
end;
/

-- -----------------------------------------------------
-- Table Conductors
-- -----------------------------------------------------
CREATE  TABLE Conductors (
  CondID INT NOT NULL PRIMARY KEY,
  Department VARCHAR2(45) NULL ,
  EmpID INT NOT NULL ,
  Address VARCHAR2(45),
  Birthday DATE,
  Sex VARCHAR2(10),
  Age int,
  Email VARCHAR2(40),
  Description VARCHAR2(100),
  CONSTRAINT fk_Conductors_Employees1
    FOREIGN KEY (EmpID )
    REFERENCES Employees (EmpID ) );
  
--auto_increment
create sequence Conductors_id_seq start with 1 increment by 1;
create or replace trigger Conductors_insert
before insert on Conductors
for each row
begin
    select Conductors_id_seq.nextval into :new.CondID from dual;
end;
/


-- -----------------------------------------------------
-- Table Administrators
-- -----------------------------------------------------
CREATE  TABLE Administrators (
  AdminID INT NOT NULL PRIMARY KEY ,
  Department VARCHAR2(45) NULL ,
  EmpID INT NOT NULL ,
  Address VARCHAR2(45),
  Birthday DATE,
  Sex VARCHAR2(10),
  Age int,
  Email VARCHAR2(40),
  Description VARCHAR2(100),
  CONSTRAINT fk_Administrators_Employees
    FOREIGN KEY (EmpID )
    REFERENCES Employees (EmpID ) );

--auto_increment
create sequence Administrators_id_seq start with 1 increment by 1;
create or replace trigger Administrators_insert
before insert on Administrators
for each row
begin
    select Administrators_id_seq.nextval into :new.AdminID from dual;
end;
/


-- -----------------------------------------------------
-- Table Customers
-- -----------------------------------------------------
CREATE  TABLE Customers (
  CustomID INT NOT NULL PRIMARY KEY ,
  Firstname VARCHAR2(45) NOT NULL ,
  Lastname VARCHAR2(45) NOT NULL ,
  Address VARCHAR2(45) NOT NULL,
  Username VARCHAR2(45) NOT NULL,
  Password VARCHAR2(45) NOT NULL,
  Birthday DATE,
  Sex VARCHAR2(10),
  Age int,
  Email VARCHAR2(40) );
  
--auto_increment
create sequence Customers_id_seq start with 1 increment by 1;
create or replace trigger Customers_insert
before insert on Customers
for each row
begin
    select Customers_id_seq.nextval into :new.CustomID from dual;
end;
/


-- -----------------------------------------------------
-- Table Payments
-- -----------------------------------------------------
CREATE  TABLE Payments (
  PayID INT NOT NULL,
  Method VARCHAR2(45) NOT NULL ,
  Details VARCHAR2(45) NOT NULL ,
  Total_Cost DECIMAL(12) NOT NULL ,
  CustomID INT NOT NULL ,
  CONSTRAINT Payments_pk PRIMARY KEY (PayID, CustomID) ,
  CONSTRAINT fk_Payments_Customers1
    FOREIGN KEY (CustomID )
    REFERENCES Customers (CustomID ) );
  
--auto_increment
create sequence Payments_id_seq start with 1 increment by 1;
create or replace trigger Payments_insert
before insert on Payments
for each row
begin
    select Payments_id_seq.nextval into :new.PayID from dual;
end;
/



-- -----------------------------------------------------
-- Table Reservations
-- -----------------------------------------------------
CREATE  TABLE Reservations (
  ResvID INT NOT NULL PRIMARY KEY,
  CustomID INT NOT NULL ,
  Reservation_Date DATE NOT NULL ,
  CONSTRAINT fk_Reservations_Customers1
    FOREIGN KEY (CustomID )
    REFERENCES Customers (CustomID ));
	
--create index
CREATE UNIQUE INDEX Reservations_Customers1_index ON Reservations (CustomID );

--auto_increment
create sequence Reservations_id_seq start with 1 increment by 1;
create or replace trigger Reservations_insert
before insert on Reservations
for each row
begin
    select Reservations_id_seq.nextval into :new.ResvID from dual;
end;
/


-- -----------------------------------------------------
-- Table Cars
-- -----------------------------------------------------
CREATE  TABLE Cars (
  CarSN INT NOT NULL PRIMARY KEY,
  Model VARCHAR2(45) NOT NULL ,
  Manufacturer VARCHAR2(45) NOT NULL ,
  Location VARCHAR2(45) NOT NULL ,
  ServiceDate DATE NOT NULL ,
  Type VARCHAR2(45) NOT NULL ,
  MaxWeight DECIMAL(10) NOT NULL ,
  ResvID INT ,
  CustomID INT ,
  Price INT,
  CONSTRAINT fk_Cars_Reservations1
    FOREIGN KEY (ResvID)
    REFERENCES Reservations (ResvID),
  CONSTRAINT fk_Cars_Customers1
	FOREIGN KEY (CustomID )
    REFERENCES Customers (CustomID ));
--auto_increment
create sequence CarSN_id_seq start with 1 increment by 1;
create or replace trigger CarSN_insert
before insert on Cars
for each row
begin
    select CarSN_id_seq.nextval into :new.CarSN from dual;
end;
/

-- -----------------------------------------------------
-- Table Trains
-- -----------------------------------------------------
CREATE  TABLE Trains (
  TrainNumber INT NOT NULL ,
  DepartureCity VARCHAR2(45) NULL ,
  DestinationCity VARCHAR2(45) NULL ,
 AdminID INT NOT NULL ,
  PRIMARY KEY (TrainNumber) ,
  CONSTRAINT fk_Trains_Administrators1
    FOREIGN KEY (AdminID )
    REFERENCES Administrators (AdminID ) );
--auto increment
create sequence TrainNumber_id_seq start with 1 increment by 1;
create or replace trigger TrainNumber_insert
before insert on Trains
for each row
begin
    select TrainNumber_id_seq.nextval into :new.TrainNumber from dual;
end;
/

-- -----------------------------------------------------
-- Table Equipments
-- -----------------------------------------------------
CREATE  TABLE Equipments (
  EqID INT NOT NULL PRIMARY KEY,
  Type VARCHAR2(45) NOT NULL ,
  Location VARCHAR2(45) NOT NULL ,
  Manufacturer VARCHAR2(45) NULL ,
  Load_Capacity DECIMAL(10) NULL );

--auto increment
create sequence EqID_id_seq start with 1 increment by 1;
create or replace trigger EqID_insert
before insert on Equipments
for each row
begin
    select EqID_id_seq.nextval into :new.EqID from dual;
end;
/
-- -----------------------------------------------------
-- Table Locomotives
-- -----------------------------------------------------
CREATE  TABLE Locomotives (
  LocSN INT NOT NULL PRIMARY KEY,
  Model VARCHAR2(45) NOT NULL ,
  Engine_Type VARCHAR2(45) NOT NULL ,
  manufacturer VARCHAR2(45) NULL ,
  Location VARCHAR2(45) NOT NULL ,
  Service_date DATE NULL ,
  Uses VARCHAR2(45) NULL);

--auto increment
create sequence LocSN_id_seq start with 1 increment by 1;
create or replace trigger LocSN_insert
before insert on Locomotives
for each row
begin
    select LocSN_id_seq.nextval into :new.LocSN from dual;
end;
/

-- -----------------------------------------------------
-- Table Employee Assignments
-- -----------------------------------------------------
CREATE  TABLE Employee_Assignments (
  EmpAssignment_Date DATE NOT NULL ,
  CondID INT NOT NULL ,
  EngID INT NOT NULL ,
  TrainNumber INT NOT NULL ,
  CONSTRAINT Employee_Assignment_fk PRIMARY KEY (CondID, EngID),
  CONSTRAINT fk_EmpAssignments_Conductors1
    FOREIGN KEY (CondID)
    REFERENCES Conductors (CondID ),
  CONSTRAINT fk_EmpAssignments_Engineers1
    FOREIGN KEY (EngID )
    REFERENCES Engineers (EngID ),
  CONSTRAINT fk_EmpAssignments_Trains1
    FOREIGN KEY (TrainNumber )
    REFERENCES Trains (TrainNumber ) );


-- -----------------------------------------------------
-- Table Equipments Assignments
-- -----------------------------------------------------
CREATE  TABLE Equipments_Assignments (
  EqAssignment_Date DATE NOT NULL ,
  EqID INT NOT NULL ,
  TrainNumber INT NOT NULL ,
  CONSTRAINT EqAssignment_pk PRIMARY KEY (EqID, TrainNumber) ,
  CONSTRAINT fk_EqAssignments_Equipments1
    FOREIGN KEY (EqID)
    REFERENCES Equipments (EqID),
  CONSTRAINT fk_EqAssignments_Trains1
    FOREIGN KEY (TrainNumber)
    REFERENCES Trains (TrainNumber));



-- -----------------------------------------------------
-- Table Locomotives Assignments
-- -----------------------------------------------------
CREATE  TABLE Locomotive_Assignments (
  LocAssignment_Date DATE NOT NULL ,
  LocSN INT NOT NULL ,
  TrainNumber INT NOT NULL ,
  CONSTRAINT LocAssignment_pk PRIMARY KEY (LocSN, TrainNumber) ,
  CONSTRAINT fk_LocAssignments_Locomotives1
    FOREIGN KEY (LocSN )
    REFERENCES Locomotives (LocSN ),
  CONSTRAINT fk_LocAssignments_Trains1
    FOREIGN KEY (TrainNumber )
    REFERENCES Trains (TrainNumber ));



-- -----------------------------------------------------
-- Table Cars Assignments
-- -----------------------------------------------------
CREATE  TABLE Cars_Assignments (
  CarsAssignment_Date DATE NOT NULL ,
  TrainNumber INT NOT NULL ,
  CarSN INT NOT NULL ,
  CONSTRAINT CarsAssignment_pk PRIMARY KEY (TrainNumber,CarSN) ,
  CONSTRAINT fk_CarsAssignments_Trains1
    FOREIGN KEY (TrainNumber )
    REFERENCES Trains (TrainNumber),
  CONSTRAINT fk_CarsAssignments_Cars1
    FOREIGN KEY (CarSN )
    REFERENCES Cars (CarSN ));

-- -----------------------------------------------------
-- Table Weblogging
-- -----------------------------------------------------

CREATE TABLE Weblogging(
  LogID INT NOT NULL PRIMARY KEY,
  UserType VARCHAR2(10) NOT NULL ,
  Username VARCHAR2(45) NOT NULL ,
  DateOfChange DATE NOT NULL);
  
  --auto_increment
create sequence Weblogging_id_seq start with 1 increment by 1;
create or replace trigger Weblogging_insert
before insert on Weblogging
for each row
begin
    select Weblogging_id_seq.nextval into :new.LogID from dual;
end;
/
