package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;


/**
 *
 * @author Cristian
 */
@Entity
@Table(name="Modalidad", schema="dayclass")
public class Modalidad implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    private Date fechaAltaModalidad;
    private Date fechaBajaModalidad;
    private String nombre;
    
    public Modalidad(){
        
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaAltaModalidad() {
        return fechaAltaModalidad;
    }

    public void setFechaAltaModalidad(Date fechaAltaModalidad) {
        this.fechaAltaModalidad = fechaAltaModalidad;
    }

    public Date getFechaBajaModalidad() {
        return fechaBajaModalidad;
    }

    public void setFechaBajaModalidad(Date fechaBajaModalidad) {
        this.fechaBajaModalidad = fechaBajaModalidad;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }
}
