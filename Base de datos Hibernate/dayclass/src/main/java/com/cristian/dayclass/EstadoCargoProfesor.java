/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
 * @author Leandro
 */
@Entity
@Table(name="EstadoCargoProfesor", schema="dayclass")
public class EstadoCargoProfesor implements Serializable{
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaFinEstCargo;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaInicioEstCargo;
    private String nombreEstadoCargoProfe;

    public EstadoCargoProfesor() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaFinEstCargo() {
        return fechaFinEstCargo;
    }

    public void setFechaFinEstCargo(Date fechaFinEstCargo) {
        this.fechaFinEstCargo = fechaFinEstCargo;
    }

    public Date getFechaInicioEstCargo() {
        return fechaInicioEstCargo;
    }

    public void setFechaInicioEstCargo(Date fechaInicioEstCargo) {
        this.fechaInicioEstCargo = fechaInicioEstCargo;
    }

    public String getNombreEstadoCargoProfe() {
        return nombreEstadoCargoProfe;
    }

    public void setNombreEstadoCargoProfe(String nombreEstadoCargoProfe) {
        this.nombreEstadoCargoProfe = nombreEstadoCargoProfe;
    }
    
    
}
