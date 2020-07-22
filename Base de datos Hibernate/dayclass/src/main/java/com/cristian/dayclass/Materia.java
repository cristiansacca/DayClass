package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.persistence.Temporal;
/**
 *
 * @author zc
 */
@Entity
@Table(name="Materia", schema="dayclass")
public class Materia implements Serializable{
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaAltaMateria;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaBajaMateria;
    private int nivelMateria;
    private String nombreMateria;
    
    public Materia(){
        
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaAltaMateria() {
        return fechaAltaMateria;
    }

    public void setFechaAltaMateria(Date fechaAltaMateria) {
        this.fechaAltaMateria = fechaAltaMateria;
    }

    public Date getFechaBajaMateria() {
        return fechaBajaMateria;
    }

    public void setFechaBajaMateria(Date fechaBajaMateria) {
        this.fechaBajaMateria = fechaBajaMateria;
    }

    public int getNivelMateria() {
        return nivelMateria;
    }

    public void setNivelMateria(int nivelMateria) {
        this.nivelMateria = nivelMateria;
    }

    public String getNombreMateria() {
        return nombreMateria;
    }

    public void setNombreMateria(String nombreMateria) {
        this.nombreMateria = nombreMateria;
    }
    
}
