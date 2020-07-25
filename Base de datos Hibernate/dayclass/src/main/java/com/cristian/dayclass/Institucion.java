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
@Table(name="Institucion", schema="dayclass")
public class Institucion implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaAltaInstitucion;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaBajaInstitucion;
    private String nombreInstitucion;
    
    public Institucion(){
        
    }

    public Date getFechaAltaInstitucion() {
        return fechaAltaInstitucion;
    }

    public void setFechaAltaInstitucion(Date fechaAltaInstitucion) {
        this.fechaAltaInstitucion = fechaAltaInstitucion;
    }

    public Date getFechaBajaInstitucion() {
        return fechaBajaInstitucion;
    }

    public void setFechaBajaInstitucion(Date fechaBajaInstitucion) {
        this.fechaBajaInstitucion = fechaBajaInstitucion;
    }

    public String getNombreInstitucion() {
        return nombreInstitucion;
    }

    public void setNombreInstitucion(String nombreInstitucion) {
        this.nombreInstitucion = nombreInstitucion;
    }
    
    
}