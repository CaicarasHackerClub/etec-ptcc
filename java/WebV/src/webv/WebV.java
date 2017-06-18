package webv;

import java.io.File;
import javafx.application.Application;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.Dialog;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.Background;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.HBox;
import static javafx.scene.paint.Color.web;
import javafx.scene.web.WebView;
import javafx.stage.Stage;

/**
 *
 * @author matheusy
 */
public class WebV extends Application {
    
    @Override
    public void start(Stage primaryStage) {

        BorderPane painel = new BorderPane();
        HBox barra = new HBox();
        
        barra.setStyle("-fx-background-color: rgba(255, 255, 255, 1);");
        
        String dir = System.getProperty("user.dir")+"/src/webv/";
        File img1 = new File(dir+"retornar.png");
        File img2 = new File(dir+"home.png");
        File img3 = new File(dir+"atualizar.png");
        File img4 = new File(dir+"avancar.png");
        
        Button btn1 = new Button("",new ImageView(new Image(img1.toURI().toString())));
        Button btn2 = new Button("",new ImageView(new Image(img2.toURI().toString())));
        Button btn3 = new Button("",new ImageView(new Image(img3.toURI().toString())));
        Button btn4 = new Button("",new ImageView(new Image(img4.toURI().toString())));
        
        barra.getChildren().addAll(btn1,btn2,btn3,btn4);
        barra.setAlignment(Pos.CENTER);
        barra.setSpacing(10);
        barra.setBackground(Background.EMPTY);
        barra.setPadding(new Insets(10));
        
        WebView web = new WebView();
        web.getEngine().load("https://elaleph.com.br/hug-health/");
        
        
        btn1.setOnAction(event ->{
            web.getEngine().executeScript("history.back()");
        });
        
        btn4.setOnAction(event ->{
            web.getEngine().executeScript("history.forward()");  
        });
        
        btn2.setOnAction(event ->{
            web.getEngine().load("http://google.com");
        });
        
        btn3.setOnAction(event ->{
            web.getEngine().reload();
        });
        
        web.getEngine().setOnAlert(event -> showAlert(event.getData())); 
        web.getEngine().setConfirmHandler(message -> showConfirm(message));
        
        
        
        painel.setCenter(web);
        painel.setTop(barra);
        
        primaryStage.setScene(new Scene(painel, 800, 600));
        primaryStage.show();

    }
    
    private void showAlert(String message) {
        Dialog<Void> alert = new Dialog<>();
        alert.getDialogPane().setContentText(message);
        alert.getDialogPane().getButtonTypes().add(ButtonType.OK);
        alert.showAndWait();
    }

    private boolean showConfirm(String message) {
        Dialog<ButtonType> confirm = new Dialog<>();
        confirm.getDialogPane().setContentText(message);
        confirm.getDialogPane().getButtonTypes().addAll(ButtonType.YES, ButtonType.NO);
        boolean result = confirm.showAndWait().filter(ButtonType.YES::equals).isPresent();

        // for debugging:
        System.out.println(result);

        return result ;
    }

    
    public static void main(String[] args) {
        Application.launch(args);
    }
}

