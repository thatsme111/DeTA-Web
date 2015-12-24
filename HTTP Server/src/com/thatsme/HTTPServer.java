package com.thatsme;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.ServerSocket;
import java.net.Socket;

import javax.swing.JButton;
import javax.swing.JFrame;

public class HTTPServer {
	
	private static final int PORT = 9999;
	private static final String HOST = "127.0.0.1";
	
	private ServerSocket serverSocket;
	private Socket client;
	private OutputStream clientOutputStream;
	private InputStream clientInputStream;
	
	public void initializeGUI(){
		JFrame frame = new JFrame("Server");
		frame.setLayout(null);
		
		JButton button = new JButton("click");
		button.setLocation(0, 0);
		button.setSize(100, 100);
		frame.add(button);
		button.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent event) {
				try {
					clientOutputStream.write("<p>paragraph</p>".getBytes());
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
		
		frame.setSize(400, 400);
		frame.setVisible(true);
	}
	
	public HTTPServer() {
		initializeGUI();
		try {
			this.serverSocket = new ServerSocket(PORT);
			System.out.println("server started...");
			
			this.client = this.serverSocket.accept();
			this.clientInputStream = this.client.getInputStream();
			this.clientOutputStream = this.client.getOutputStream();
			
			System.out.println("client connected :"+client);
			
			//reading current request
			byte[] buffer = new byte[1024];
			this.clientInputStream.read(buffer);
			System.out.println(new String(buffer));
			
			//adding headers
			String responseString = 
					"HTTP/1.x 200 OK\r\n"
					+ "Content-Type: text/html\r\n";
			responseString += "\r\n";
			
			//adding body
			responseString += "<h1>ThatsME</h1>"; 
			
			System.out.println("Response:\n"+responseString);
			this.clientOutputStream.write(responseString.getBytes());
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	public static void main(String[] args) {
		new HTTPServer();
//		try{
//			ServerSocket server = new ServerSocket(8080);
//			System.out.println("Listening for connection on port 8080 ....");
//			while(true){
//				try(Socket socket = server.accept()){
//					Date today = new Date();
//					String httpResponse = "HTTP/1.1 200 OK\r\n\r\n" + today;
//					socket.getOutputStream().write(httpResponse.getBytes("UTF-8"));
//				}
//			}
//		}catch(Exception e){
//			e.printStackTrace();
//		}
	}

}
