package com.thatsme;

import java.io.InputStream;
import java.io.OutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.Date;

public class HTTPServer {
	
	private static final int PORT = 9999;
	private static final String HOST = "127.0.0.1";
	
	private ServerSocket serverSocket;
	private Socket client;
	
	public HTTPServer() {
		try {
			this.serverSocket = new ServerSocket(PORT);
			System.out.println("server started...");
			this.client = this.serverSocket.accept();
			System.out.println("client connected :"+client);
			InputStream inputStream = this.client.getInputStream();
			byte[] buffer = new byte[1024];
			inputStream.read(buffer);
			System.out.println(new String(buffer));
			
			OutputStream outputStream = this.client.getOutputStream();
			//adding headers
			String responseString = 
					"HTTP/1.x 200 OK\r\n"
					+ "Content-Type: text/html\r\n";
			responseString += "\r\n";
			
			//adding body
			responseString += "<h1>ThatsME</h1>"; 
			
			System.out.println("Response:\n"+responseString);
			outputStream.write(responseString.getBytes());
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
