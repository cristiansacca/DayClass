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
 * @author Cristian
 */
@Entity
@Table(name="TemasMateria", schema="dayclass")
public class TemasMateria implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaDesdeTemMat;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date feTemasMachaHastaTemMat;
    private String nombreTema;
    
    public TemasMateria(){
        
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaDesdeTemMat() {
        return fechaDesdeTemMat;
    }

    public void setFechaDesdeTemMat(Date fechaDesdeTemMat) {
        this.fechaDesdeTemMat = fechaDesdeTemMat;
    }

    public Date getFeTemasMachaHastaTemMat() {
        return feTemasMachaHastaTemMat;
    }

    public void setFeTemasMachaHastaTemMat(Date feTemasMachaHastaTemMat) {
        this.feTemasMachaHastaTemMat = feTemasMachaHastaTemMat;
    }

    public String getNombreTema() {
        return nombreTema;
    }

    public void setNombreTema(String nombreTema) {
        this.nombreTema = nombreTema;
    }
    
    
    
}