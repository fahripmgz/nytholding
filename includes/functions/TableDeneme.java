/*
 *Suhan Duman (suhan@turkserve.net)
 */

import java.awt.event.*;
import java.awt.Window;
import java.awt.*;
import java.sql.*;
import java.io.*;
import java.util.Vector;    
import java.util.EventObject;
import javax.swing.*;
import javax.swing.table.*;
import javax.swing.event.*;

/* ***********************BWM class********************* */
/* ***********************BWM class********************* */
/* ***********************BWM class********************* */
/* ***********************BWM class********************* */
/* ***********************BWM class********************* */

class BasicWindowMonitor extends WindowAdapter{
   public void windowClosing(WindowEvent e)
   {
     Window w=e.getWindow();
     w.setVisible(false);
     w.dispose();
     System.exit(0);
   }
}

/* ***********************QTM class********************* */ 
/* ***********************QTM class********************* */ 
/* ***********************QTM class********************* */ 
/* ***********************QTM class********************* */ 
/* ***********************QTM class********************* */ 
//this is a generic class.
//it can expand itself to the column count and 
//it is adaptable to any table.
//if you adapted it to your tables,
//you have to change the sql in "setValueAt" method,
//and also the database name in "TableDeneme" class.

class QueryTableModel extends AbstractTableModel{
 
 Vector cache;
 int colCount;
 String[] headers;
 Connection db;
 Statement statement;
 String currentURL;
 String kolon;

 public QueryTableModel()
 {
  cache=new Vector();
  try{
    Class.forName("sun.jdbc.odbc.JdbcOdbcDriver").newInstance();
  }catch(java.lang.Exception e){
	System.err.println("Class not found exception : ");
	System.err.println(e.getMessage());
  }
 }//konstr. sonu
 
 /*****abstracttablemodel methodlarý******/
 public String getColumnName(int i) {return headers[i];}
 public int getColumnCount() {return colCount;}
 public int getRowCount() {return cache.size();}

 public Object getValueAt(int row,int col){
   	return ((String[])cache.elementAt(row))[col];
  }
 
 public boolean isCellEditable(int row, int col){ return true; }

 public void setValueAt(Object value, int row, int col) {//are you editing?
 	/*prepare the query*/
 	/*you have to change the query to adapt it to your table*/
 	if(col==0) kolon="english";
 	if(col==1) kolon="turkish";
 	String s="update soz set " + kolon + " = '" + (String)value + "' where " + kolon + " = '" + ((String[])cache.elementAt(row))[col] + "'";
   	System.out.println(s);
   	/*excecute the query*/
   	try{
   	statement.execute(s);
	}catch(Exception e){System.out.println("Could not updated");}
    
    ((String[])cache.elementAt(row))[col] = (String)value;
	fireTableCellUpdated(row, col);//also update the table
 }
 /*****end of abstracttablemodel methodlarý******/

 public void setHostURL(String url){
   if(url.equals(currentURL))
   {return;}
   closeDB();
   initDB(url);
   currentURL=url;
 }

 public void setQuery(String q){
 cache= new Vector();
 try{
    ResultSet rs=statement.executeQuery(q);
    ResultSetMetaData meta=rs.getMetaData();
    colCount=meta.getColumnCount();
    headers=new String[colCount];
    for (int h=1;h<=colCount;h++)
      {
      headers[h-1]=meta.getColumnName(h);
      }
    while(rs.next())
      {
      String[] record=new String[colCount];
      for(int i=0;i<colCount;i++)
        {record[i]=rs.getString(i+1);}
      cache.addElement(record);
      } //while sonu

    fireTableChanged(null);
    } //try sonu
    catch(Exception e){
    cache=new Vector();
    e.printStackTrace();
    }
 } //setQuery sonu

 public void initDB(String url){
 try {
     db=DriverManager.getConnection(url);
     statement=db.createStatement();
     }catch(Exception e){
       System.out.println("Database could not started");
       e.printStackTrace();
     }
 } //initDB sonu

 public void closeDB(){
   try {
       if(statement!= null) {statement.close();}
       if(db != null) {db.close();}
       }catch(Exception e){
       System.out.println("Database could not closed");
       e.printStackTrace();
       }
 }  //closeDB sonu

}

/* ***********************TableDeneme class********************* */
/* ***********************TableDeneme class********************* */
/* ***********************TableDeneme class********************* */
/* ***********************TableDeneme class********************* */

public class TableDeneme extends JFrame{

QueryTableModel qtm;
JTable table;
JScrollPane scrollpane;
JPanel p1,p2;
JButton jb;
ListSelectionModel rowSM;
	
public TableDeneme(){
	super("Dictionary Window");
    qtm=new QueryTableModel();
    table=new JTable(qtm);
    scrollpane=new JScrollPane(table);
    p1=new JPanel();
    jb=new JButton("get em all");
    p1.add(jb);
   	
   	getContentPane().add(p1,BorderLayout.NORTH);
    getContentPane().add(scrollpane,BorderLayout.CENTER);
    addWindowListener(new BasicWindowMonitor());
    setSize(500,500);
    setVisible(true);
  	
  	JOptionPane.showMessageDialog(new Frame(),"Press the button,\n" 
   				   +"It will fill the table with all records.\n" 
   				   +"Then you can edit the cells.\n"
   				   +"When you select another cell, the previous one will updated.\n\n"
   				   +"suhan@turkserve.net");
   	
    
  	/******show selection*****
  	table.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
	rowSM = table.getSelectionModel();
	rowSM.addListSelectionListener(new ListSelectionListener(){
		public void valueChanged(ListSelectionEvent e){
			if (e.getValueIsAdjusting()) return;
				ListSelectionModel lsm = (ListSelectionModel)e.getSource();
				if (lsm.isSelectionEmpty()){
					System.out.println("No rows are selected.");
				}
				else{
				System.out.println(table.getValueAt(table.getSelectionModel().getMinSelectionIndex(),0));
				System.out.println(table.getValueAt(table.getSelectionModel().getMinSelectionIndex(),1));
				}
		}
	}); 
	**********************/

	jb.addActionListener(new ActionListener(){
      public void actionPerformed(ActionEvent e){
        qtm.setHostURL("jdbc:odbc:;DRIVER=Microsoft Access Driver (*.mdb);UID=admin;UserCommitSync=Yes;Threads=3;SafeTransactions=0;PageTimeout=5;MaxScanRows=8;MaxBufferSize=2048;FIL=MS Access;DriverId=281;DBQ=db1.mdb");
	  	qtm.setQuery("select * from soz");
		}
      });
  	
 }
        
public static void main(String[] args){
	TableDeneme td=new TableDeneme();
   	}
}

