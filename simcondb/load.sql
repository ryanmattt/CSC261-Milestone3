LOAD DATA LOCAL INFILE '/home/simcondb/attendee.csv' INTO TABLE Attendee
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (First_Name, Last_Name, Email, ID, Ticket_Type, Mailing_List, Date_Checked_In);

  LOAD DATA LOCAL INFILE '/home/simcondb/staff.csv' INTO TABLE Staff
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (First_Name, Last_Name, ID, Primary_Team, Rank, Password);

  LOAD DATA LOCAL INFILE '/home/simcondb/event.csv' INTO TABLE Event
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (Event_ID, Staff_Event_Runner_ID, Attendee_Event_Runner_ID, Max_Attendees, Length_Minutes, Name, Description, Time);

  LOAD DATA LOCAL INFILE '/home/simcondb/event_attendee_staff.csv' INTO TABLE Event_Attendee_Staff
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (ID, Event_ID);

  LOAD DATA LOCAL INFILE '/home/simcondb/event_attendee_attendee.csv' INTO TABLE Event_Attendee_Attendee
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (ID, Event_ID);

  LOAD DATA LOCAL INFILE '/home/simcondb/stock.csv' INTO TABLE Stock
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (SKU, Cost, Size, Quantity);

  LOAD DATA LOCAL INFILE '/home/simcondb/item_category.csv' INTO TABLE Item_Category
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (Item_Name, Category);

  LOAD DATA LOCAL INFILE '/home/simcondb/sale.csv' INTO TABLE Sale
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\n'
  IGNORE 1 LINES
  (Sale_ID, Total, Date_Purchased, Quantity, SKU, Customer_ID_Staff, Customer_ID_Attendee);