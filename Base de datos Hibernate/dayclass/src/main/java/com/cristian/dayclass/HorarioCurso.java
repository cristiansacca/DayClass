package com.cristian.dayclass;

import java.io.Serializable;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;


/**
 *
 * @author Cristian
 */
@Entity
@Table(name="HorarioCurso", schema="dayclass")
public class HorarioCurso implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    private int horaFinCurso;
    private int horaInicioCurso;
    
    @ManyToOne
    private CursoDia cursoDia;
        
    public HorarioCurso(){
        
    }

    public int getHoraFinCurso() {
        return horaFinCurso;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setHoraFinCurso(int horaFinCurso) {
        this.horaFinCurso = horaFinCurso;
    }

    public int getHoraInicioCurso() {
        return horaInicioCurso;
    }

    public void setHoraInicioCurso(int horaInicioCurso) {
        this.horaInicioCurso = horaInicioCurso;
    }

    public CursoDia getCursoDia() {
        return cursoDia;
    }

    public void setCursoDia(CursoDia cursoDia) {
        this.cursoDia = cursoDia;
    }

    
}
